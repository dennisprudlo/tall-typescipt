class Application {

    /**
     * The application locale
     */
    public readonly locale: string;

    /**
     * Instantiates the application
     */
    constructor () {

        //
        // Read application locale
        this.locale = document.querySelector('html')?.getAttribute('lang') ?? 'de';
    }

    /**
     * Registers a new application-ready handler
     * @param handler The function to execute when the application is ready
     * @returns The application
     */
    public ready (handler: Function) : Application {
        window.addEventListener('DOMContentLoaded', event => handler(event));

        return this;
    }

    /**
     * Binds a value to the window object
     * @param properties An object of properties to bind
     * @returns The application
     */
    public bind (properties: object) : Application {
        for (let property in properties) {
            (window as any)[property] = properties[property];
        }

        return this;
    }
}

export const app = new Application();
