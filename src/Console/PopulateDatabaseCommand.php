<?php

namespace App\Console;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Office;
use Faker\Factory;
use Faker\Generator;
use Slim\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateDatabaseCommand extends Command
{
    private App $app;
    private Generator $faker;

    public function __construct(App $app)
    {
        $this->faker = Factory::create('fr_FR');
        $this->app = $app;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('db:populate');
        $this->setDescription('Populate database');
    }

    protected function createCompany() : Company
    {
        $company = new Company();
        $company->name = $this->faker->name;
        $company->phone = $this->faker->phoneNumber;
        $company->email = $this->faker->url;
        $company->image = $this->faker->image;
        $company->save();

        return $company;
    }

    protected function createOffice(Company $company) : Office
    {
        $office = new Office();
        $office->name = $this->faker->name;
        $office->address = $this->faker->address;
        $office->city = $this->faker->city;
        $office->country = $this->faker->country;
        $office->zip_code = $this->faker->postcode;
        $office->email = $this->faker->email;
        $office->phone = $this->faker->phoneNumber;
        $office->company()->associate($company);
        $office->save();

        return $office;
    }

    protected function createEmployee(Office $office)
    {
        $employees = new Employee();
        $employees->first_name = $this->faker->firstName;
        $employees->last_name = $this->faker->lastName;
        $employees->email = $this->faker->email;
        $employees->phone = $this->faker->phoneNumber;
        $employees->job_title = $this->faker->jobTitle;
        $employees->office()->associate($office);
        $employees->save();
    }

    protected function execute(InputInterface $input, OutputInterface $output ): int
    {
        $output->writeln('Populate database...');

        /**
         *
         *
         * @var \Illuminate\Database\Capsule\Manager $db
         */
        $db = $this->app->getContainer()->get('db');

        $db->getConnection()->statement("SET FOREIGN_KEY_CHECKS=0");
        $db->getConnection()->statement("TRUNCATE `employees`");
        $db->getConnection()->statement("TRUNCATE `offices`");
        $db->getConnection()->statement("TRUNCATE `companies`");
        $db->getConnection()->statement("SET FOREIGN_KEY_CHECKS=1");

        for ($i = 0; $i < 10; $i++) {
            $company = $this->createCompany();
            for ($j = 0; $j < 2; $j++) {
                $office = $this->createOffice($company);
                for ($k = 0; $k < 5; $k++) {
                    $this->createEmployee($office);
                }
            }
            $company->head_office_id = $company->offices()->first()->id;
            $company->save();
        }

        $output->writeln('Database created successfully!');
        return 0;
    }
}
