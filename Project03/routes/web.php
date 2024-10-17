<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventTitleController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BlogLikesController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\EventSpeakerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GeneralInfoController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BlogSectionController;
use App\Http\Controllers\BroughtTickets;
use App\Http\Controllers\BroughtTicketsController;
use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\ConnectionsController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\RecomendationController;
use FTP\Connection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.welcome');
    } else {
        return redirect()->route('login');
    }
});

Route::get('/admin', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('admin.welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // USERS
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users')->middleware('checkRole:admin');
        Route::get('/{id}/show', [UserController::class, 'show'])->name('user.show')->middleware('checkRole:admin');
        Route::get('/create', [UserController::class, 'create'])->name('user.create')->middleware('checkRole:admin');
        Route::post('/create', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');
        Route::get('/search', [UserController::class, 'search'])->name('users.search')->middleware('checkRole:admin');
    });

    // CONNECTIONS
    // Route::prefix('user/connections')->group(function () {
    //     Route::post('/create', [ConnectionsController::class, 'store'])->name('user.connection.store');
    //     Route::put('/{id}/edit', [ConnectionsController::class, 'update'])->name('user.connection.update');
    //     Route::delete('/{id}/delete', [ConnectionsController::class, 'destroy'])->name('user.connection.delete');
    // });

    // FAVOURITES
    // Route::prefix('/user/favourites')->group(function () {
    //     Route::post('/create', [FavouritesController::class, 'store'])->name('blog.favourite.store');
    //     Route::delete('/{id}/delete', [FavouritesController::class, 'destroy'])->name('blog.favourites.delete');
    // });

    // BROUGHT TICKETS
    // Route::prefix('/user/broughtTickets')->group(function () {
    //     Route::post('/create', [BroughtTicketsController::class, 'store'])->name('user.ticket.store');
    // });


    // BLOGS
    Route::prefix('/blogs')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blogs')->middleware('checkRole:admin');
        Route::get('/{id}/show', [BlogController::class, 'show'])->name('blog.show')->middleware('checkRole:admin');
        Route::get('/create', [BlogController::class, 'create'])->name('blog.create')->middleware('checkRole:admin');
        Route::post('/create', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/{id}/delete', [BlogController::class, 'destroy'])->name('blog.delete');
        Route::get('/search', [BlogController::class, 'search'])->name('blogs.search')->middleware('checkRole:admin');
    });

    // BLOG SECTIONS
    Route::prefix('/blog/section')->group(function () {
        Route::get('/create/{blog_id}', [BlogSectionController::class, 'create'])->name('blog.section.create')->middleware('checkRole:admin');
        Route::post('/create', [BlogSectionController::class, 'store'])->name('blog.section.store');
        Route::get('/{id}/edit', [BlogSectionController::class, 'edit'])->name('blog.section.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [BlogSectionController::class, 'update'])->name('blog.section.update');
        Route::delete('/{id}/delete', [BlogSectionController::class, 'destroy'])->name('blog.section.delete');
    });


    // COMMENTS
    Route::prefix('/comments')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('comments')->middleware('checkRole:admin');
        // Route::post('/create', [CommentController::class, 'store'])->name('comment.store');
        // Route::put('/{id}/edit', [CommentController::class, 'update'])->name('comment.update');
        Route::delete('/{id}/delete', [CommentController::class, 'destroy'])->name('comment.delete');
        Route::get('/search', [CommentController::class, 'search'])->name('comments.search')->middleware('checkRole:admin');
    });

    // BLOG LIKES
    // Route::prefix('/blog/likes')->group(function () {
    //     Route::post('/create', [BlogLikesController::class, 'store'])->name('blog.like.store');
    //     Route::delete('/{id}/delete', [BlogLikesController::class, 'destroy'])->name('blog.like.delete');
    // });

    // COMMENT LIKES
    // Route::prefix('/comment/likes')->group(function () { 
    //     Route::post('/create', [CommentLikesController::class, 'store'])->name('comment.like.store');
    //     Route::delete('/{id}/delete', [CommentLikesController::class, 'destroy'])->name('comment.like.delete');
    // });


    // EVENTS
    Route::prefix('/events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events')->middleware('checkRole:admin');
        Route::get('/{id}/show', [EventController::class, 'show'])->name('event.show')->middleware('checkRole:admin');
        Route::get('/create', [EventController::class, 'create'])->name('event.create')->middleware('checkRole:admin');
        Route::post('/create', [EventController::class, 'store'])->name('event.store')->middleware('checkRole:admin');
        Route::get('/{id}/edit', [EventController::class, 'edit'])->name('event.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [EventController::class, 'update'])->name('event.update')->middleware('checkRole:admin');
        Route::delete('/{id}/delete', [EventController::class, 'destroy'])->name('event.delete')->middleware('checkRole:admin');
        Route::get('/search', [EventController::class, 'search'])->name('events.search')->middleware('checkRole:admin');
    });


    // EVENT TITLES
    Route::prefix('/event/titles')->group(function () {
        Route::get('/', [EventTitleController::class, 'index'])->name('event.titles')->middleware('checkRole:admin');
        Route::get('/create', [EventTitleController::class, 'create'])->name('event.title.create')->middleware('checkRole:admin');
        Route::post('/create', [EventTitleController::class, 'store'])->name('event.title.store')->middleware('checkRole:admin');
        Route::get('/{id}/edit', [EventTitleController::class, 'edit'])->name('event.title.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [EventTitleController::class, 'update'])->name('event.title.update')->middleware('checkRole:admin');
        Route::delete('/{id}/delete', [EventTitleController::class, 'destroy'])->name('event.title.delete')->middleware('checkRole:admin');
        Route::get('/search', [EventTitleController::class, 'search'])->name('event.title.search')->middleware('checkRole:admin');
    });


    // AGENDA
    Route::prefix('/event/agenda')->group(function () {
        Route::get('/create/{event_id}', [AgendaController::class, 'create'])->name('event.agenda.create')->middleware('checkRole:admin');
        Route::post('/create', [AgendaController::class, 'store'])->name('event.agenda.store')->middleware('checkRole:admin');
        Route::get('/{id}/edit', [AgendaController::class, 'edit'])->name('event.agenda.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [AgendaController::class, 'update'])->name('event.agenda.update')->middleware('checkRole:admin');
        Route::delete('/{id}/delete', [AgendaController::class, 'destroy'])->name('event.agenda.delete')->middleware('checkRole:admin');
    });

    // SPEAKERS
    Route::prefix('/speakers')->group(function () {
        Route::get('/', [SpeakerController::class, 'index'])->name('speakers')->middleware('checkRole:admin');
        Route::get('/{id}/show', [SpeakerController::class, 'show'])->name('speaker.show')->middleware('checkRole:admin');
        Route::get('/create', [SpeakerController::class, 'create'])->name('speaker.create')->middleware('checkRole:admin');
        Route::post('/create', [SpeakerController::class, 'store'])->name('speaker.store')->middleware('checkRole:admin');
        Route::get('/{id}/edit', [SpeakerController::class, 'edit'])->name('speaker.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [SpeakerController::class, 'update'])->name('speaker.update')->middleware('checkRole:admin');
        Route::delete('/{id}/delete', [SpeakerController::class, 'destroy'])->name('speaker.delete')->middleware('checkRole:admin');
        Route::get('/search', [SpeakerController::class, 'search'])->name('speakers.search')->middleware('checkRole:admin');
    });

    // EVENT SPEAKERS
    Route::prefix('/event/speakers')->group(function () {
        Route::get('/create/{event_id}', [EventSpeakerController::class, 'create'])->name('event.speaker.create')->middleware('checkRole:admin');
        Route::post('/create', [EventSpeakerController::class, 'store'])->name('event.speaker.store')->middleware('checkRole:admin');
        Route::get('/{id}/edit', [EventSpeakerController::class, 'edit'])->name('event.speaker.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [EventSpeakerController::class, 'update'])->name('event.speaker.update')->middleware('checkRole:admin');
        Route::delete('/{id}/delete', [EventSpeakerController::class, 'destroy'])->name('event.speaker.delete')->middleware('checkRole:admin');
    });

    // TICKETS
    Route::prefix('/event/ticket')->group(function () {
        Route::get('/create/{event_id}', [TicketController::class, 'create'])->name('event.ticket.create')->middleware('checkRole:admin');
        Route::post('/create', [TicketController::class, 'store'])->name('event.ticket.store')->middleware('checkRole:admin');
        Route::get('/{id}/edit', [TicketController::class, 'edit'])->name('event.ticket.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [TicketController::class, 'update'])->name('event.ticket.update')->middleware('checkRole:admin');
        Route::delete('/{id}/delete', [TicketController::class, 'destroy'])->name('event.ticket.delete')->middleware('checkRole:admin');
    });


    // FEEDBACKS
    Route::prefix('/feedbacks')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('feedbacks')->middleware('checkRole:admin');
        // Route::post('/create', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('checkRole:guest');
        // Route::put('/{id}/edit', [FeedbackController::class, 'update'])->name('feedback.update')->middleware('checkRole:guest');
        Route::delete('/{id}/delete', [FeedbackController::class, 'destroy'])->name('feedback.delete');
        Route::get('/search', [FeedbackController::class, 'search'])->name('feedbacks.search')->middleware('checkRole:admin');
    });


    // EMPLOYEE
    Route::prefix('/employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees')->middleware('checkRole:admin');
        Route::get('/{id}/show', [EmployeeController::class, 'show'])->name('employee.show')->middleware('checkRole:admin');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create')->middleware('checkRole:admin');
        Route::post('/create', [EmployeeController::class, 'store'])->name('employee.store')->middleware('checkRole:admin');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [EmployeeController::class, 'update'])->name('employee.update')->middleware('checkRole:admin');
        Route::delete('/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.delete')->middleware('checkRole:admin');
        Route::get('/search', [EmployeeController::class, 'search'])->name('employee.search')->middleware('checkRole:admin');
    });


    // GENERAL INFO
    Route::prefix('/generalInfo')->group(function () {
        Route::get('/', [GeneralInfoController::class, 'index'])->name('generalInfo')->middleware('checkRole:admin');
        Route::get('/{id}/edit', [GeneralInfoController::class, 'edit'])->name('generalInfo.edit')->middleware('checkRole:admin');
        Route::put('/{id}/edit', [GeneralInfoController::class, 'update'])->name('generalInfo.update')->middleware('checkRole:admin');
    });

    // RECOMMENDATIONS
    Route::prefix('/recommendations')->group(function () {
        Route::get('/', [RecomendationController::class, 'index'])->name('recommendations')->middleware('checkRole:admin');
        // Route::post('/create', [RecomendationController::class, 'store'])->name('recommendation.store');
        // Route::put('/{id}/edit', [RecomendationController::class, 'update'])->name('recommendation.update');
        Route::delete('/{id}/delete', [RecomendationController::class, 'destroy'])->name('recommendation.delete');
        Route::get('/search', [RecomendationController::class, 'search'])->name('recommendation.search')->middleware('checkRole:admin');
    });
});

require __DIR__ . '/auth.php';
