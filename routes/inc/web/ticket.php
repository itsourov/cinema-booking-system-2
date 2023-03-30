<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('ticket')->middleware(['auth'])->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
    Route::put('/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
    Route::delete('/{ticket}', [TicketController::class, 'destroy'])->name('ticket.delete');
    Route::get('/{ticket}/download', [TicketController::class, 'download'])->name('ticket.download');
    Route::get('/{ticket}/vr-show', [TicketController::class, 'vr_show'])->name('ticket.vr-show');
});
