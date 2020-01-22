<?php

namespace Tests\Unit;

use App\Models\Upload;
use App\Utils\UploadUtils;
use PHPUnit\Framework\TestCase;

class UploadUtilsTest extends TestCase {

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $uploads;

    protected function setUp(): void {
        parent::setUp();

        $this->uploads = collect([
            new Upload([
                'id' => 1,
                'mime_type' => 'image/jpeg',
            ]),
            new Upload([
                'id' => 2,
                'mime_type' => 'image/png',
            ]),
            new Upload([
                'id' => 3,
                'mime_type' => 'image/jpeg',
            ]),
        ]);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGroupingTest() {
        $groups = UploadUtils::groupUploadsByTypes($this->uploads);


        $this->assertEquals(2, count($groups));

        $this->assertEquals('image/jpeg', $groups[0]['title']);
        $this->assertEquals('image/png', $groups[1]['title']);

        $this->assertEquals(2, count($groups[0]['files']));
        $this->assertEquals(1, count($groups[1]['files']));

        $this->assertEquals(1, $groups[0]['files'][0]->id);
        $this->assertEquals(3, $groups[0]['files'][1]->id);
        $this->assertEquals(2, $groups[1]['files'][0]->id);

        $this->assertEquals('image/jpeg', $groups[0]['files'][0]->mime_type);
        $this->assertEquals('image/jpeg', $groups[0]['files'][1]->mime_type);
        $this->assertEquals('image/png',  $groups[1]['files'][0]->mime_type);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGroupingTestWhichFails() {
        $groups = UploadUtils::groupUploadsByTypes($this->uploads);

        $this->assertEquals(3, count($groups));
    }

}
