<?php namespace Tests\Repositories;

use App\Models\department;
use App\Repositories\departmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class departmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var departmentRepository
     */
    protected $departmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->departmentRepo = \App::make(departmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_department()
    {
        $department = factory(department::class)->make()->toArray();

        $createddepartment = $this->departmentRepo->create($department);

        $createddepartment = $createddepartment->toArray();
        $this->assertArrayHasKey('id', $createddepartment);
        $this->assertNotNull($createddepartment['id'], 'Created department must have id specified');
        $this->assertNotNull(department::find($createddepartment['id']), 'department with given id must be in DB');
        $this->assertModelData($department, $createddepartment);
    }

    /**
     * @test read
     */
    public function test_read_department()
    {
        $department = factory(department::class)->create();

        $dbdepartment = $this->departmentRepo->find($department->id);

        $dbdepartment = $dbdepartment->toArray();
        $this->assertModelData($department->toArray(), $dbdepartment);
    }

    /**
     * @test update
     */
    public function test_update_department()
    {
        $department = factory(department::class)->create();
        $fakedepartment = factory(department::class)->make()->toArray();

        $updateddepartment = $this->departmentRepo->update($fakedepartment, $department->id);

        $this->assertModelData($fakedepartment, $updateddepartment->toArray());
        $dbdepartment = $this->departmentRepo->find($department->id);
        $this->assertModelData($fakedepartment, $dbdepartment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_department()
    {
        $department = factory(department::class)->create();

        $resp = $this->departmentRepo->delete($department->id);

        $this->assertTrue($resp);
        $this->assertNull(department::find($department->id), 'department should not exist in DB');
    }
}
