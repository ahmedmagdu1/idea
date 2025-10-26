@extends('layouts.app')

@section('title', 'Press')

@section('content')
<style>
    * {
/* Hero text exact mapping (Figma) */
.aboutus-hero .aboutus-title {
  color: #fff;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-style: normal;
  font-size: 57.96px;
  line-height: 1.33;
  letter-spacing: 0;
  vertical-align: middle;
}
.aboutus-hero .aboutus-lead {
  color: #fff;
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 26.39px;
  line-height: 1.0;
  letter-spacing: 0;
  text-align: center;
}

/* Hero Section */
.hero-section {
  position: relative;
  height: 620px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.hero-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 1;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #161c2d;
  opacity: 0.7;
  z-index: 2;
}

.hero-content {
  position: relative;
  z-index: 3;
  text-align: center;
  color: white;
  padding: 0 2rem;
  animation: fadeInUp 1s ease;
}

.hero-title {
  font-size: 3.625rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  animation: fadeInUp 1s ease 0.2s backwards;
}

.hero-description {
  font-size: 1.65rem;
  max-width: 894px;
  margin: 0 auto;
  line-height: 1.6;
  animation: fadeInUp 1s ease 0.4s backwards;
}
</style>

    <!-- Hero Section -->
  <section class="hero-section">
    <div class="hero-overlay"></div>
    <img src="https://images.unsplash.com/photo-1495020689067-958852a7765e?q=80&w=1600&auto=format&fit=crop" alt="Background" class="hero-bg">
    <div class="hero-content">
      <h1 class="hero-title text-light">Press & Blog</h1>
      <p class="hero-description text-light">
     Updates, case studies, and stories.
     </p>
    </div>
  </section>



<div class="container py-5">
  <div class="row g-4">
    @forelse($items as $item)
      <div class="col-md-6 col-lg-4">
        <div class="card h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-1"><a href="{{ url('/press/'.$item->slug) }}">{{ $item->title }}</a></h5>
            <div class="text-muted small mb-2">{{ optional($item->published_at)->format('M d, Y') }}</div>
            <p class="card-text flex-grow-1">{{ Str::limit($item->excerpt ?: strip_tags($item->body), 140) }}</p>
            <a class="btn btn-brand mt-2" href="{{ url('/press/'.$item->slug) }}">Read more</a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center text-muted">No posts yet.</div>
    @endforelse
  </div>
  <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection

