<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Contracts\HasTable;
use App\Models\Note;
use App\Models\Reactionm;
use App\Models\User;
use Closure;
use Filament\Pages\Actions\Action as Actionn;
use Illuminate\Support\Facades\DB;

class ListPosts extends Page implements HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.list-posts';

    protected static ?string $title = 'List Post';

    public $record;

    public $a;

    public function mount(): void
    {
    }


    protected function getTableQuery(): Builder

    {
        return Note::query()->where('user_id', $this->record)->orderBy('updated_at', 'desc');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')->color('primary')->words(1)->sortable()->searchable(),
            Tables\Columns\TextColumn::make('title')->limit(10)->sortable()->searchable(),
            Tables\Columns\TextColumn::make('content')->limit(20)->sortable()->searchable(),
            Tables\Columns\ImageColumn::make('image_note_path')->label('Image Post')->disk('s3')->circular(),
            Tables\Columns\TextColumn::make('status')->getStateUsing( function (Note $record){
                if($record->status === "1"){
                    $status = "Active";
                }else{
                    $status = "Loked";}
                return $status;}),
            Tables\Columns\TextColumn::make('Comments')->getStateUsing(function (Note $record) {
                return $record->comments()->count();
            }),
            Tables\Columns\TextColumn::make('Reactionms')->getStateUsing(function (Note $record) {
                return $record->reactionms()->count();
            }),
            Tables\Columns\TextColumn::make('Reactionms')->getStateUsing(function (Note $record) {
                return Reactionm::where('reactionmable_id', $record->id)->count();
            }),
            Tables\Columns\TextColumn::make('Tags')->getStateUsing(function (Note $record) {
                return ($record->tags()->where('status', '1')->get()->count());
            }),
            Tables\Columns\TextColumn::make('updated_at')->date(),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actionn::make('Back')
                ->url(route('filament.resources.users.view', ['record' => $this->record]))
                ->color('secondary')
                ->button(),
        ];
    }
    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn (Note $record): string => route('filament.resources.users.show-post-user', ['record' => $record]);
    }
}
