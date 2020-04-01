import AppListing from '../admin/app-components/Listing/AppListing';

Vue.component('product-listing', {
    mixins: [AppListing],
    props: [ 'keywords' ],
    created () {
        this.search = this.keywords
    }
});
