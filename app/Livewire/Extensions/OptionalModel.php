<?php

namespace App\Http\Livewire;

use Livewire\Wireable;

/**
 * @template TModel
 */
final class OptionalModel implements Wireable {

    /**
     * The class string
     *
     * @var class-string<TModel>
     */
    public string $class;

    /**
     * The model key
     *
     * @var string|null
     */
    public ?string $key;

    /**
     * The model instance
     *
     * @var TModel|null
     */
    public $model = null;

    /**
     * Constructs the wireable object
     *
     * @param class-string<TModel> $class
     * @param string|null $key
     */
    public function __construct(string $class, ?string $key = null)
    {
        $this->class = $class;
        $this->key = $key;
        $this->model = isset($key) ? $class::secret($key) : null;
    }

    /**
     * Check whether the model exists
     *
     * @return boolean
     */
    public function exists() : bool
    {
        return isset($this->model);
    }

    /**
     * Converts class data to object datat
     *
     * @return array<class-string<TModel>, string>
     */
    public function toLivewire() : array
    {
        return [ $this->class => $this->key ];
    }

    /**
     * Converts object data to class data
     *
     * @param array<class-string<TModel>, string> $value
     * @return OptionalModel<TModel>
     */
    public static function fromLivewire($value) : OptionalModel
    {
        return new static(
            array_keys($value)[0],
            array_values($value)[0]
        );
    }
}
