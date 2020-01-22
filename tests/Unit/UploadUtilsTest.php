<?php

namespace Tests\Unit;

use App\Models\Upload;
use App\Utils\UploadUtils;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class UploadUtilsTest extends TestCase {

    /**
     * @var Collection
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
     * Test grouping when mime type is empty
     * @return void
     */
    public function testGroupingTestWithEmptyMimeType() {
        $uploads = collect([
            new Upload([
                'id' => 1,
                'mime_type' => '',
            ])
        ]);

        $groups = UploadUtils::groupUploadsByTypes($uploads);

        $this->assertEquals(0, count($groups));
    }

}
