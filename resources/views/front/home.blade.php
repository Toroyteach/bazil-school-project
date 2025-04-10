@extends('layouts.front')
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-5 hero-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7 col-md-12">
                    <h1 class="mb-3 text-primary">We Care Your Baby</h1>
                    <h1 class="mb-5 display-1 text-white">The Best Play Area For Your Kids</h1>
                    <a href="" class="btn btn-primary px-4 py-3 px-md-5  me-4 btn-border-radius">Get Started</a>
                    <a href="" class="btn btn-primary px-4 py-3 px-md-5 btn-border-radius">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="container-fluid py-5 about bg-light">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="video border">
                        <button type="button" class="btn btn-play" data-bs-toggle="modal"
                            data-src="" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                    <h4
                        class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                        About Us</h4>
                    <h1 class="text-dark mb-4 display-5">We Learn Smart Way To Build Bright Futute For Your Children</h1>
                    <p class="text-dark mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. the
                        printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                        since the 1500s, when an unknown printer Lorem Ipsum has been the industry's standard dummy text
                        ever since the 1500s.
                    </p>
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <h6 class="mb-3"><i class="fas fa-check-circle me-2"></i>Sport Activites</h6>
                            <h6 class="mb-3"><i class="fas fa-check-circle me-2 text-primary"></i>Outdoor Games</h6>
                            <h6 class="mb-3"><i class="fas fa-check-circle me-2 text-secondary"></i>Nutritious Foods</h6>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="mb-3"><i class="fas fa-check-circle me-2"></i>Highly Secured</h6>
                            <h6 class="mb-3"><i class="fas fa-check-circle me-2 text-primary"></i>Friendly Environment</h6>
                            <h6><i class="fas fa-check-circle me-2 text-secondary"></i>Qualified Teacher</h6>
                        </div>
                    </div>
                    <a href="" class="btn btn-primary px-5 py-3 btn-border-radius">More Details</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Video -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                    What We Do</h4>
                <h1 class="mb-5 display-3">Thanks To Get Started With Our School</h1>
            </div>
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="text-center border-primary border bg-white service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-inner">
                                <div class="p-4"><i class="fas fa-gamepad fa-6x text-primary"></i></div>
                                <a href="#" class="h4">Study & Game</a>
                                <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, culpa qui
                                    officiis animi Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit.</p>
                                <a href="#" class="btn btn-primary text-white px-4 py-2 my-2 btn-border-radius">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="text-center border-primary border bg-white service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-inner">
                                <div class="p-4"><i class="fas fa-sort-alpha-down fa-6x text-primary"></i></div>
                                <a href="#" class="h4">A to Z Programs</a>
                                <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, culpa qui
                                    officiis animi Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit.</p>
                                <a href="#" class="btn btn-primary text-white px-4 py-2 my-2 btn-border-radius">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="text-center border-primary border bg-white service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-inner">
                                <div class="p-4"><i class="fas fa-users fa-6x text-primary"></i></div>
                                <a href="#" class="h4">Expert Teacher</a>
                                <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, culpa qui
                                    officiis animi Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit.</p>
                                <a href="#" class="btn btn-primary text-white px-4 py-2 my-2 btn-border-radius">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="text-center border-primary border bg-white service-item">
                        <div class="service-content d-flex align-items-center justify-content-center p-4">
                            <div class="service-content-inner">
                                <div class="p-4"><i class="fas fa-user-nurse fa-6x text-primary"></i></div>
                                <a href="#" class="h4">Mental Health</a>
                                <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, culpa qui
                                    officiis animi Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit.</p>
                                <a href="#" class="btn btn-primary text-white px-4 py-2 my-2 btn-border-radius">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Blog Start-->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                    Latest News & Blog</h4>
                <h1 class="mb-5 display-3">Our Latest News</h1>
            </div>
            <div class="row g-5 justify-content-center">

                @if ($posts->isEmpty())
                    <p>No blog posts found.</p>
                @else
                    @foreach ($posts as $post)
                        <div class="col-md-6 col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="blog-item rounded-bottom">
                                <div class="blog-img overflow-hidden position-relative img-border-radius">
                                    <!-- <img src="{{ $post->files->first()?->url ?? asset('img/default.jpg') }}" class="img-fluid w-100" alt="Image"> -->
                                </div>
                                <div
                                    class="d-flex justify-content-between px-4 py-3 bg-light border-bottom border-primary blog-date-comments">
                                    <small class="text-dark"><i class="fas fa-calendar me-1 text-dark"></i>
                                        {{ $post->created_at->format('d M Y') }}</small>
                                    <small class="text-dark"><i class="fas fa-comment-alt me-1 text-dark"></i> Comments
                                        ({{ $post->comments_count ?? 0 }})</small>
                                </div>
                                <div class="blog-content d-flex align-items-center px-4 py-3 bg-light">
                                    <div class="overflow-hidden rounded-circle rounded-top border border-primary">
                                        <!-- <img src="{{ $post->author->profile_photo_url ?? asset('img/user-default.jpg') }}" class="img-fluid rounded-circle p-2 rounded-top" alt="Image" style="width: 70px; height: 70px; border-style: dotted; border-color: var(--bs-primary) !important;"> -->
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="text-primary">{{ $post->author->name }}</h6>
                                        <p class="text-muted">{{ ucfirst($post->type) }}</p>
                                    </div>
                                </div>
                                <div class="px-4 pb-4 bg-light rounded-bottom">
                                    <div class="blog-text-inner">
                                        <a href="{{ route('blog.show', $post->slug) }}" class="h4">{{ $post->title }}</a>
                                        <p class="mt-3 mb-4">{{ Str::limit($post->description, 100) }}</p>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('blog.show', $post->slug) }}"
                                            class="btn btn-primary text-white px-4 py-2 mb-3 btn-border-radius">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-center mt-4">
                        {{ $posts->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- Blog End-->
@endsection