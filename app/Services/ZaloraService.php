<?php

namespace App\Services;

class ZaloraService {

    protected const SERVICE_URL = 'https://www.zalora.com.hk/_c/v1/desktop/list_catalog_full?params=';

    private $request = [
        "url" => "/women/clothing", 
        "q" => "", 
        "sort" => "popularity", 
        "dir" => "desc", 
        "offset" => 0, 
        "limit" => 99, 
        "category_id" => ["3"], 
        "range" => [], 
        "occasion" => [], 
        "material_composition" => [], 
        "pattern" => [], 
        "campaign_categoryId" => [], 
        "color" => [], 
        "sizesystem" => [], 
        "brand" => [], 
        "age_group" => [], 
        "gender" => ["women"], 
        "price" => "", 
        "normalized_sell_through" => "", 
        "segment" => "women", 
        "special_price" => false, 
        "all_products" => false, 
        "new_products" => false, 
        "top_sellers" => false, 
        "catalogtype" => "Main", 
        "campaign" => "", 
        "discount" => "", 
        "age" => "", 
        "mp" => "", 
        "or" => "", 
        "shipment_type" => "", 
        "exs" => "", 
        "lang" => "en", 
        "is_brunei" => false, 
        "sort_formula" => "", 
        "rerank_formula" => "", 
        "search_suggest" => false, 
        "custom_filters" => [
            "filter1" => "", 
            "filter2" => "", 
            "filter3" => "", 
            "filter4" => "" 
        ], 
        "elevate_ids" => [], 
        "user_id" => "", 
        "enable_visual_sort" => true, 
        "enable_filter_ads" => true, 
        "features" => [
            "compact_catalog_desktop" => false, 
            "name_search" => false, 
            "solr7_support" => false, 
            "pick_for_you" => false, 
            "learn_to_sort_catalog" => false 
        ], 
        "onsite_filters" => [], 
        "user_query" => "" 
    ]; 

    public function categories() {
        $response = $this->getResponse();
        return $response->category_tree->children;
    }

    public function brands() {
        $response = $this->getResponse();
        return (array) $response->brands;
    }

    public function items(int $offset) {
        $this->request['offset'] = $offset;
        $response = $this->getResponse();
        return $response->response->docs;
    }

    private function getResponse() {
        $this->request['onsite_filters'] = json_decode('{}');

        return json_decode(
            file_get_contents(
                Self::SERVICE_URL.
                urlencode(
                    json_encode($this->request, JSON_UNESCAPED_SLASHES)
                )
            )
        );
    }
}
