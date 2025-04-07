<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\File;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Total Posts
            Stat::make('Total Posts', Post::count())
                ->description('All blog/event/story posts')
                ->descriptionIcon('heroicon-m-document-text'),

            // Published Posts
            Stat::make('Published Posts', Post::where('status', 'published')->count())
                ->description('Currently published posts')
                ->descriptionIcon('heroicon-m-eye'),

            // Draft Posts
            Stat::make('Drafts', Post::where('status', 'draft')->count())
                ->description('Posts in draft mode')
                ->descriptionIcon('heroicon-m-pencil'),

            // Active Events
            Stat::make('Active Events', Post::where('type', 'event')
                ->where('is_active', true)
                ->whereDate('ends_at', '>=', now())->count())
                ->description('Live and upcoming events')
                ->descriptionIcon('heroicon-m-calendar-days'),

            // Blogs/Stories Combined
            Stat::make('Blogs & Stories', Post::whereIn('type', ['blog', 'story'])->count())
                ->description('Informational content')
                ->descriptionIcon('heroicon-m-book-open'),

            // Files Attached
            Stat::make('Total Files', File::count())
                ->description('All uploaded files')
                ->descriptionIcon('heroicon-m-paper-clip'),

            // Images Only
            Stat::make('Images', File::where('type', 'image')->count())
                ->description('Post image files')
                ->descriptionIcon('heroicon-m-photo'),

            // Videos Linked
            Stat::make('Video Links', Post::whereNotNull('meta->video_link')->count())
                ->description('Posts with video URLs')
                ->descriptionIcon('heroicon-m-video-camera'),

            // New Posts This Month
            Stat::make('New Posts This Month', Post::whereMonth('created_at', now()->month)->count())
                ->description('Posts added this month')
                ->descriptionIcon('heroicon-m-clock'),
        ];
    }
}
