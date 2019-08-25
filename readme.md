<h4>This project is built backend by Laravel and frontend by Vue. Users tabls is used MYSQL still, Blogs Table is used MongoDB. Both frontend and backend have been built unittests. Backend unittest is built by phpunit. Frontend unittest is built by Jest. The JWT is included in this project.</h4>

<p>All the base things, you should be read and learn from "https://github.com/ramseyjiang/SPA_Laravel_JWT_Vue_Fullstack" first.</p>

<p>Step1: git clone this project to your local</p>
<p>Step2: composer install</p>
<p>Step3: cp .env.example .env</p>
<p>Step4: modify the database, root, password in the .env file. modify config/database.php, update the MongoDb config the same with your local.</p>
<p>Step5: php artisan key:generate</p>
<p>Step6: php artisan jwt:secret</p>
<p>Step7: php artisan migrate</p>
<p>Step8: php artisan db:seed --class UserTableSeeder</p>
<p>Step9: ./vendor/bin/phpunit</p>
<p>If all unittests passed, it means the backend works. After these above, you also can use: "php artisan app:name xxx" to update the whole project appName.</p>
<p>After that, let's make frontend works.</p>
<p>Step10: npm install</p>
<p>Step11: npm run dev (Make sure frontend complie works.)</p>
<p>Step12: npm run format (Make sure auto format frontend files work.)</p>
<p>Step13: npm run test (If it works fine, it means frontend unittests work.)</p>
<p>You also can do git commit and git push in your command, to make sure when you do commit or push, it will run frontend unitest first.</p>

<p>If you wanna to learn how to do this project step by step, you can follow steps under below.</p>
<p>This readme only describes how to install and config this project, if you wanna to know the base platform how to build it, please follow this link "https://github.com/ramseyjiang/SPA_Laravel_JWT_Vue_Fullstack"</p>

<p>All steps under below are base on the fullstack you have learnt.</p>

<p>Step0: git clone https://github.com/ramseyjiang/SPA_Laravel_JWT_Vue_Fullstack.git project_name </p>

<p>Step1: rm -rf .git (It is used to remove all git history.)</p>

<p>Step2: composer install</p>

<p>Step3: cp .env.example .env </p>

<p>Step4: modify the database, root, password in the .env file. modify config/database.php, update the MongoDb config the same with your local.</p>

<p>Step5: php artisan key:generate</p>

<p>Step6: php artisan jwt:secret</p>

<p>Step7: php artisan migrate</p>

<p>Step8: php artisan db:seed --class UserTableSeeder</p>

<p>Step9: ./vendor/bin/phpunit  (To make sure the backend works, then you can use "php artisan app:name AppName" to change app name or not, it is up to you.)</p>

<p>Step10: composer require jenssegers/mongodb </p>

<p>Step11: php artisan make:controller BlogController --resource (It will generate BlogController and some default methods)</p>

<p>Step12: php artisan make:request BlogRequest (It will generate BlogRequest in a requests folder)</p>

<p>Step13: php artisan make:model Log -m (It will generate Log.php outside Models folder, you should move it into Models folder and update the namespace as AppName/Models. It also will generate a new file in the database/migrations folder, you should fill the table content.)</p>

<p>Step14: php artisan make:model Blog (It will generate a Blog model outside Models folder, you should move it into Models folder.)</p>

<p>Step15: php artisan make:policy BlogPolicy (It will generate a BlogPolicy file in the policies folder.)</p>

<p>Step16: php artisan make:observer BlogObserver (It will generate a BlogObserver file in the Observers folder)</p>

<p>Step17: php artisan make:test BlogTest (It will generate a BlogTest file in the tests/Feature folder.)</p>

<p>Step18: create BlogList.vue, Blog.vue in the resources/js/components folder, create BlogList.test.js, Blog.test.js in the resources/js/tests folder</p>

<p>Step19: Update routes.js</p>

<p>After all steps above, you can copy code from each matches file content from this project file.</p>
<p>Run "npm run dev" to compile, after that run "npm run test" to test whether frontend works or not. </p>
<p>If all the above works, this project works. Thanks for your time. If you like this project, please add a star for me. Thanks and cheers.</p>



