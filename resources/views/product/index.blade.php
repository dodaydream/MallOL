@extends('layout')

@section('title', trans('admin.product.actions.index'))

@section('content')



<product-listing
    :data="{{ $data->toJson() }}"
    :url="'{{ url('products') }}'"
    inline-template>

    <div>
        <section class="hero">
          <div class="hero-body">
            <div class="container">
              <h1 class="title">
                Browse
              </h1>
              <h2 class="subtitle">
                Browse a variety of products we can offer
              </h2>
            </div>
          </div>
        </section>

        <div class="columns">
            <div class="column is-one-quarter">
                <form @submit.prevent="">
                    <b-input placeholder="Search..."
                        type="search"
                        icon="magnify"
                        v-model="search" @keyup.enter="filter('search', $event.target.value)" 
                        icon-clickable
                        @icon-click="filter('search', search)">
                    </b-input>

                </form>
                <br />

                <div class="card">
                  <header class="card-header">
                    <p class="card-header-title">
                        Categories
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                      <b-icon icon="chevron-down"></b-icon>
                    </a>
                  </header>
                  <div class="card-content">
                      <ul>
                        <li v-for="c in {{ $categories }}">
                            <div class="field">
                                <b-checkbox>
                                    @{{ c.name }}
                                </b-checkbox>
                            </div>
                        </li>
                      </ul>
                  </div>
                </div>

                <div class="card">
                  <header class="card-header">
                    <p class="card-header-title">
                        Brands
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                      <b-icon icon="chevron-down"></b-icon>
                    </a>
                  </header>
                  <div class="card-content">
                      <ul>
                        <li v-for="b in {{ $brands }}">
                            <div class="field">
                                <b-checkbox>
                                    @{{ b.name }}
                                </b-checkbox>
                            </div>
                        </li>
                      </ul>
                  </div>
                </div>

            </div>

            <div class="column">

                <div>
                    <span>@{{ data.total }} items found</span>
                    <b-select v-model="pagination.state.per_page" style="display:inline">
                                
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="100">100</option>
                    </b-select>
                </div>

                <div class="columns is-multiline">
                    <div class="column is-one-third" v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                        <a :href="`/product/${item.id}`">
                            <div class="card">
                                <div class="card-image">
                                    <figure class="image is-2by3">
                                        <img :src="item.thumb_url" :alt="item.name">
                                    </figure>
                                </div>
                                <div class="card-content" style="white-space: nowrap; text-overflow: ellipsis">
                                    <p class="title is-6">@{{ item.name }}</p>
                                    <p>MOP$ @{{ item.price }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div>
                    <div>
                        <pagination></pagination>
                    </div>
                </div>

                <div class="no-items-found" v-if="!collection.length > 0">
                    <i class="icon-magnifier"></i>
                    <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                    <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                </div>
            </div>
        </div>
    </div>

</product-listing>

@endsection
