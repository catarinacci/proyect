<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\Page;
use App\Models\User;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Contracts\HasTable;
use Filament\Pages\Actions\Action as Actionn;

class Locked extends Page implements HasTable
{

    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Users Loked';

    protected static string $view = 'filament.resources.user-resource.pages.locked';

    protected function getTableQuery(): Builder 
    {

        return User::query()->where('status', '2')->orderBy('updated_at', 'desc');
    } 
    protected function getTableColumns(): array 
    {  
        
        return [ 
            Tables\Columns\TextColumn::make('id')->color('primary')->words(1)->sortable()->searchable(),
            Tables\Columns\TextColumn::make('name')->sortable()->searchable()->wrap(),
            Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
            Tables\Columns\ImageColumn::make('profile_photo_path')->label('Profile photo')->disk('s3')->circular(),
            Tables\Columns\TextColumn::make('updated_at')->sortable()->date(),
            Tables\Columns\TextColumn::make('email_verified_at')->date(),
            Tables\Columns\TextColumn::make('status')->getStateUsing( function (User $record){
                if($record->status === "1"){
                    $status = "Active";
                }else{
                    $status = "Loked";}
                return $status;})->sortable()->searchable()
        ]; 
    }
    protected function getActions(): array
    {
        return [
           Actionn::make('Back')
           ->url(route('filament.resources.users.index')),
        ];
    }
}

