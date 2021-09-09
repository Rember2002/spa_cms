<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AcademicOfferController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IntegrantController;
use App\Http\Controllers\NewHomeController;
use App\Http\Controllers\NewItemController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SalesianExperienceController;
use App\Http\Controllers\SalesianExperienceHomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceHomeController;
use App\Http\Controllers\StrategicAllieController;
use App\Http\Controllers\StudentCouncilController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [AuthenticateController::class, 'register']);

Route::post('login', [AuthenticateController::class, 'login']);

Route::apiResource('aboutus', AboutUsController::class);

Route::apiResource('academicOffers', AcademicOfferController::class);

Route::apiResource('contactUs', ContactUsController::class);

Route::apiResource('newHomes', NewHomeController::class);

Route::apiResource('carousels', CarouselController::class);

Route::apiResource('categories', CategorieController::class);

Route::apiResource('commisions', CommissionController::class);

Route::apiResource('grades', GradeController::class);

Route::apiResource('images', ImageController::class);

Route::apiResource('integrants', IntegrantController::class);

Route::apiResource('newItems', NewItemController::class);

Route::apiResource('questions', QuestionController::class);

Route::apiResource('resources', ResourceController::class);

Route::apiResource('salesianExperiences', SalesianExperienceController::class);

Route::apiResource('salesianExperienceHomes', SalesianExperienceHomeController::class);

Route::apiResource('services', ServiceController::class);

Route::apiResource('servicesHomes', ServiceHomeController::class);

Route::apiResource('strategicAllies', StrategicAllieController::class);

Route::apiResource('studentCouncils', StudentCouncilController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {

    

    Route::post('logout', [AuthenticateController::class, 'logout']);
});