<?php
namespace TektonLabs\ReactOnLaravel\Preset;

use Artisan;
use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

class ReactOnLaravelPreset extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();
        static::updateWebpackConfiguration();
        static::updateSass();
        static::updateBootstrapping();
        static::updateComponent();
        static::updateWelcomePage();
        static::removeNodeModules();
    }

    /**
     * Update the "package.json" file.
     *
     * @return void
     */
    protected static function updatePackages()
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $dependencies = static::updatePackageArray(
            $packages
        );

        $packages['dependencies'] = $dependencies['dependencies'];
        $packages['devDependencies'] = $dependencies['devDependencies'];

        ksort($packages['dependencies']);
        ksort($packages['devDependencies']);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        $packagesToAdd = [
            'axios' => '^0.17',
            'normalize.css' => '^8.0.0',
            'prop-types' => '^15.6.0',
            'react' => '^16.2.0',
            'react-dom' => '^16.2.0',
            'styled-components' => '^3.1.6',
        ];

        $packagesToAddDev = [
            'babel-eslint' => '^8.2.1',
            'babel-plugin-module-resolver' => '^3.0.0',
            'babel-preset-env' => '^1.6.1',
            'babel-preset-stage-2' => '^6.24.1',
            'babel-preset-react' => '^6.23.0',
            'browser-sync' => '^2.23.6',
            'browser-sync-webpack-plugin' => '^2.0.1',
            'cross-env' => '^5.1',
            'dotenv' => '^5.0.0',
            'eslint' => '^4.17.0',
            'eslint-config-airbnb' => '^16.1.0',
            'eslint-import-resolver-babel-module' => '^4.0.0',
            'eslint-loader' => '^1.9.0',
            'eslint-plugin-import' => '^2.8.0',
            'eslint-plugin-jsx-a11y' => '^6.0.3',
            'eslint-plugin-react' => '^7.6.1',
            'laravel-mix' => '^1.0',
        ];

        $packagesToRemove = ['vue', 'jquery', 'bootstrap', 'popper.js', 'lodash', 'axios'];
        
        return [
            'dependencies' => $packagesToAdd,
            'devDependencies' => $packagesToAddDev + Arr::except($packages['devDependencies'], $packagesToRemove),
        ];
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    protected static function updateWebpackConfiguration()
    {
        copy(__DIR__.'/react-stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.'/react-stubs/.babelrc', base_path('.babelrc'));
        copy(__DIR__.'/react-stubs/.eslintrc', base_path('.eslintrc'));
    }

    /**
     * Update the Sass files for the application.
     *
     * @return void
     */
    protected static function updateSass()
    {
        // clean up all the files in the sass folder
        $orphan_sass_files = glob(resource_path('/assets/sass/*.*'));

        foreach($orphan_sass_files as $sass_file)
        {
            (new Filesystem)->delete($sass_file);
        }

        // copy files from the stubs folder
        copy(__DIR__.'/react-stubs/sass/app.scss', resource_path('assets/sass/app.scss'));
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        (new Filesystem)->delete(
            resource_path('assets/js/bootstrap.js'),
            resource_path('assets/js/app.js')
        );

        copy(__DIR__.'/react-stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        copy(__DIR__.'/react-stubs/app.js', resource_path('assets/js/app.js'));
    }

    /**
     * Update the example component.
     *
     * @return void
     */
    protected static function updateComponent()
    {
        (new Filesystem)->copyDirectory(
            __DIR__.'/react-stubs/js',
            resource_path('assets/js')
        );

        (new Filesystem)->copyDirectory(
            __DIR__.'/react-stubs/img',
            resource_path('assets/img')
        );
    }

    /**
     * Update the default welcome page file.
     *
     * @return void
     */
    protected static function updateWelcomePage()
    {
        // remove default welcome page
        (new Filesystem)->delete(
            resource_path('views/welcome.blade.php')
        );

        // copy new one from your stubs folder
        copy(__DIR__.'/react-stubs/views/welcome.blade.php', resource_path('views/welcome.blade.php'));
    }
}
