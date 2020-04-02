@extends('layout')

@section('title', 'Home')

@section('content')
        <section class="hero">
          <div class="hero-body">
            <div class="container has-text-centered">
              <h1 class="title">
                Featured
              </h1>
            </div>
          </div>
        </section>

        <div class="tile is-ancestor">
          <div class="tile is-vertical is-8">
            <div class="tile">
              <div class="tile is-parent is-vertical">
                <article class="tile is-child notification is-primary">
                  <p class="title">Vertical...</p>
                  <p class="subtitle">Top tile</p>
                </article>
                <article class="tile is-child notification is-warning">
                  <p class="title">...tiles</p>
                  <p class="subtitle">Bottom tile</p>
                </article>
              </div>
              <div class="tile is-parent">
                <article class="tile is-child notification is-info">
                  <p class="title">Middle tile</p>
                  <p class="subtitle">With an image</p>
                  <figure class="image is-4by3">
                    <img src="https://bulma.io/images/placeholders/640x480.png">
                  </figure>
                </article>
              </div>
            </div>
            <div class="tile is-parent">
              <article class="tile is-child notification is-danger">
                <p class="title">Wide tile</p>
                <p class="subtitle">Aligned with the right tile</p>
                <div class="content">
                  <!-- Content -->
                </div>
              </article>
            </div>
          </div>
          <div class="tile is-parent">
            <article class="tile is-child notification is-success">
              <div class="content">
                <p class="title">Tall tile</p>
                <p class="subtitle">With even more content</p>
                <div class="content">
                  <!-- Content -->
                </div>
              </div>
            </article>
          </div>
        </div>    

        <section class="hero">
          <div class="hero-body">
            <div class="container has-text-centered">
              <h1 class="title">
                Featured Brands
              </h1>
            </div>
          </div>
        </section>

        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="tile is-child notification is-primary">
                  <p class="title">Vertical...</p>
                  <p class="subtitle">Top tile</p>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="tile is-child notification is-primary">
                  <p class="title">Vertical...</p>
                  <p class="subtitle">Top tile</p>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="tile is-child notification is-primary">
                  <p class="title">Vertical...</p>
                  <p class="subtitle">Top tile</p>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="tile is-child notification is-primary">
                  <p class="title">Vertical...</p>
                  <p class="subtitle">Top tile</p>
                </div>
            </div>
        </div>

        <section class="hero">
          <div class="hero-body">
            <div class="container has-text-centered">
              <h1 class="title">
                Top Category
              </h1>
            </div>
          </div>
        </section>


        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="tile is-child notification is-primary">
                  <p class="title">Vertical...</p>
                  <p class="subtitle">Top tile</p>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="tile is-child notification is-primary">
                  <p class="title">Vertical...</p>
                  <p class="subtitle">Top tile</p>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="tile is-child notification is-primary">
                  <p class="title">Vertical...</p>
                  <p class="subtitle">Top tile</p>
                </div>
            </div>
            <div class="tile is-parent">
                <div class="tile is-child notification is-primary">
                  <p class="title">Vertical...</p>
                  <p class="subtitle">Top tile</p>
                </div>
            </div>
        </div>

@endsection
