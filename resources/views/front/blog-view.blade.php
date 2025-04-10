@extends('layouts.front')
@section('content')
    <!-- Blog Detail Start -->
    <div class="container py-5">
        <div class="row g-5">
            <!-- Main Blog Content -->
            <div class="col-lg-8">
                <div class="blog-item mb-5">
                    @if($post->files->first())
                        <img src="{{ asset('storage/' . $post->files->first()->path) }}" class="img-fluid w-100 mb-4"
                            alt="{{ $post->title }}">
                    @endif
                    <h1 class="mb-3">{{ $post->title }}</h1>
                    <div class="d-flex mb-3">
                        <small class="me-3 text-muted"><i class="fas fa-user text-primary me-1"></i>
                            {{ $post->author->name ?? 'Unknown' }}</small>
                        <small class="text-muted"><i class="fas fa-calendar text-primary me-1"></i>
                            {{ $post->created_at->format('d M Y') }}</small>
                    </div>
                    <div>
                        {!! nl2br(e($post->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar Latest Posts -->
            <div class="col-lg-4">
                <h4 class="mb-4">Latest Posts</h4>
                @forelse($latestPosts as $latest)
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 me-3">
                            @if($latest->files->first())
                                <img src="{{ asset('storage/' . $latest->files->first()->path) }}" alt="{{ $latest->title }}"
                                    class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <img src="{{ asset('img/blog-placeholder.jpg') }}" alt="No Image" class="img-fluid"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <a href="{{ route('blog.show', $latest->slug) }}"
                                class="text-dark fw-bold">{{ Str::limit($latest->title, 50) }}</a>
                            <div class="text-muted small">{{ $latest->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                @empty
                    <p>No latest posts available.</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Blog Detail End -->
@endsection