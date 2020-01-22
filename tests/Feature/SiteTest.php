<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class SiteTest extends TestCase {

    use DatabaseMigrations;
    use RefreshDatabase;

    public function testBasicTest() {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Upload a File');
    }

    public function testUpload() {
        $uploadedFile = new UploadedFile(
            resource_path('test-files/1.jpeg'),
            '1.jpeg',
            'image/jpeg',
            null, null, true
        );

        $response = $this->post('/upload', [
            '_token' => Session::token(),
            'user_name' => 'alex',
            'fileUpload' => $uploadedFile,
        ]);
        $response->assertStatus(302);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('File uploaded successfully!');
    }

    public function testUploadUnsupportedFileType() {
        $uploadedFile = new UploadedFile(
            resource_path('test-files/1.jpeg'), // this path should be real, not fake
            '1.faketype',
            'fake/type',
            null, null, true
        );

        $response = $this->post('/upload', [
            '_token' => Session::token(),
            'user_name' => 'alex',
            'fileUpload' => $uploadedFile,
        ]);
        $response->assertStatus(302);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('This file type is not allowed to upload.');
    }

}
