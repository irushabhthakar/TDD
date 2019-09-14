<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\BookModel;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books',[
            'title' => 'cool book',
            'author' => 'Rushabh',
        ]);
        $response->assertOk();
        $this->assertCount(1,BookModel::all());
    }
    /**
     * A basic test example.
     *testBasicTest1
     * @return void
     */
    public function testBasicTest1(){

        // $this->withoutExceptionHandling();
        $response = $this->post('/books',[
            'title' => '',
            'author' => 'Rushabh',
        ]);

        $response->assertSessionHasErrors('title');
    }
    /**
     *a_book_can_be_updated.
     *
     * @return void
     */
    public function testBasicTest2(){
        // $this->withoutExceptionHandling();
         $this->post('/books',[
            'title' => 'Dell',
            'author' => 'Rushabh',
        ]);
            $book = BookModel::first();

         $response = $this->patch('/books/'. $book->id ,[
            'title' => 'new title',
            'author' => 'new Rush',
        ]);

        $this->assertEquals('new title',BookModel::first()->title);
        $this->assertEquals('new Rush',BookModel::first()->author);

    }
}
