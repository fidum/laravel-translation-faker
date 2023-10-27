<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

use function Orchestra\Testbench\workbench_path;
use function Pest\Laravel\artisan;
use function Pest\Laravel\withoutMockingConsoleOutput;

afterEach(function () {
    // Clean up files
    $files = app(Filesystem::class);
    $files->deleteDirectory(lang_path('da'));
    $files->deleteDirectory(workbench_path('vendor/example/lang/da'));
    $files->delete(lang_path('da.json'));
    $files->delete(workbench_path('vendor/example/lang/da.json'));
});

it('can test', function () {
    withoutMockingConsoleOutput();
    artisan('translation:fake da');
    expect(Artisan::output())->toMatchSnapshot();

    $files = array_merge(
        glob(lang_path('da/*.*')),
        glob(lang_path('da/**/*.*')),
        glob(workbench_path('vendor/example/lang/da/*.*')),
        glob(workbench_path('vendor/example/lang/da/**/*.*')),
        [
            lang_path('da.json'),
            workbench_path('vendor/example/lang/da.json'),
        ]
    );

    foreach ($files as $file) {
        expect($file)
            ->toBeReadableFile()
            ->and(file_get_contents($file))
            ->toMatchSnapshot();
    }
});
