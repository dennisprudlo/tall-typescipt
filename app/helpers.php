<?php

if (! function_exists('str')) {

    /**
     * Gets a static accessor to the \Illuminate\Support\Str class.
     * When a non-null value is passed the function behaves like Str::of()
     *
     * @param string|null $string
     * @return mixed
     */
    function str (string|null $string = null) : mixed {
        if (!isset($string)) {
            return new class {

                /**
                 * @param string $name
                 * @param array<mixed> $arguments
                 * @return string|\Illuminate\Support\Stringable
                 */
                public function __call (string $name, array $arguments) : string|\Illuminate\Support\Stringable {
                    return \Illuminate\Support\Str::$name(...$arguments);
                }
            };
        }

        return \Illuminate\Support\Str::of($string);
    }
}

if (! function_exists('current_commit')) {

    /**
     * Inspects the authorization and returns the response if forbidden
     *
     * @return object
     */
    function current_commit () : object {
        $head = file_get_contents(base_path('.git/HEAD'));
        $currentBranch = $head ? trim(last(explode('/', $head))) : 'main';
        $lastCommitTime = filemtime(base_path(sprintf('.git/refs/heads/%s', $currentBranch)));

        $lastCommitHash = file_get_contents(base_path(sprintf('.git/refs/heads/%s', $currentBranch)));
        $lastCommitHash = $lastCommitHash ? trim($lastCommitHash) : 'initial';

        return (object) [
            'branch' => $currentBranch,
            'time' => \Carbon\Carbon::createFromTimestamp($lastCommitTime ?: 0)->diffForHumans(),
            'hash' => $lastCommitHash
        ];
    }
}
