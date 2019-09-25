<?php
    
    class WEloquent
    {
        /** @var array $filters */
        private $filters = [];
        
        private function check_arguments($param, array $expected_params) {
            if(!in_array(gettype($param), $expected_params)){
                throw new InvalidArgumentException('Expected arguments are ' . $expected_params);
            }
        }
        
        /**
         * Run WP_Query
         * @return array
         */
        public function execute(): array {
            /** @var WP_Query $query */
            $query = new WP_Query($this->filters);
            
            if($query->have_posts()){
                return $query->posts;
            }

            return [];
        }
    
        /**
         * Show posts based on a keyword search.
         * @param string $search
         * @return $this
         */
        public function search(string $search) {
            $this->filters['s'] = $search;
    
            return $this;
        }
        
        /**
         * Get maximum of posts per page
         * @param int $per_page
         * @return $this
         */
        public function posts_per_page(int $per_page) {
            $this->filters['posts_per_page'] = $per_page;
            
            return $this;
        }
        
        /**
         * Set post type for search
         * @param $post_type
         * @return $this
         */
        public function post_type($post_type = 'posts') {
            $this->check_arguments($post_type, ['string', 'array']);
            
            $this->filters['post_type'] = $post_type;
            
            return $this;
        }
    
        /**
         * Ignore sticky posts to prevent prepend
         * @param bool $ignore
         * @return $this
         */
        public function ignore_sticky_posts(bool $ignore) {
            $this->filters['ignore_sticky_posts'] = $ignore;
    
            return $this;
        }
    
        /**
         * Offset posts results
         * @param int $offset
         * @return $this
         */
        public function offset(int $offset) {
            $this->filters['offset'] = $offset;
    
            return $this;
        }
    
        /**
         * Get posts by post name
         * @param string $name
         * @return $this
         */
        public function post_name(string $name){
            $this->filters['name'] = $name;
    
            return $this;
        }
    
        /**
         * Get posts by post slug
         * @param string $name
         * @return $this
         */
        public function post_slug(string $slug){
            $this->filters['pagename'] = $slug;
        
            return $this;
        }
    
        public function comment_count($count) {
            $this->check_arguments($count, ['int', 'array']);
            
            $this->filters['comment_count'] = $count;
            
            return $this;
        }
        
        /**
         * Get posts by status
         * @param string|array $status
         * @return $this
         */
        public function post_status($status) {
            $this->check_arguments($status, ['string', 'array']);
            
            $this->filters['post_status'] = $status;
            
            return $this;
        }
    
        /**
         * Use page id to return only child pages. Set to 0 to return only top-level entries.
         * @param int $parent_id
         * @return $this
         */
        public function post_parent(int $parent_id){
            $this->filters['post_parent'] = $parent_id;
        
            return $this;
        }
    
        /**
         * Specify posts whose parent is in an array
         * @param array $parent_ids
         * @return $this
         */
        public function post_parent__in(array $parent_ids){
            $this->filters['post_parent__in'] = $parent_ids;
        
            return $this;
        }
    
        /**
         * Use post ids. Specify posts whose parent is not in an array.
         * @param array $parent_ids
         * @return $this
         */
        public function post_parent__not_in(array $parent_ids){
            $this->filters['post_parent__not_in'] = $parent_ids;
    
            return $this;
        }
    
        /**
         * Specify posts to retrieve
         * @param array $ids
         * @return $this
         */
        public function post__in(array $ids){
            $this->filters['post__in'] = $ids;
    
            return $this;
        }
    
        /**
         * Specify post NOT to retrieve
         * @param array $ids
         * @return $this
         */
        public function post__not_in(array $ids){
            $this->filters['post___not_in'] = $ids;
        
            return $this;
        }
    
        /**
         * Use post slugs. Specify posts to retrieve
         * @param array $slugs
         * @return $this
         */
        public function post_name__in(array $slugs){
            $this->filters['post_name__in'] = $slugs;
        
            return $this;
        }
        
        /**
         * Search posts by author(s)
         * @param array $params
         * @return mixed
         */
        public function author(array $params) {
            array_merge($params, $this->filters);
            
            return $this;
        }
        
        /**
         * Get posts by author id
         * @param int $id
         * @return $this
         */
        public function author_id(int $id) {
            $this->filters['author'] = $id;
            
            return $this;
        }
        
        /**
         * Get posts by author name
         * @param string $name
         * @return $this
         */
        public function author_name(string $name) {
            $this->filters['author_name'] = $name;
            
            return $this;
        }
        
        /**
         * Get posts by author in array
         * @param array $in
         * @return $this
         */
        public function author__in(array $in) {
            $this->filters['author__in'] = $in;
            
            return $this;
        }
        
        /**
         * Get posts by author not in array
         * @param array $not_in
         * @return $this
         */
        public function author__not_in(array $not_in) {
            $this->filters['author__not_in'] = $not_in;
            
            return $this;
        }
        
        /**
         * Search posts by category(ies)
         * @param array $params
         * @return mixed
         */
        public function category(array $params) {
            array_merge($params, $this->filters);
            
            return $this;
        }
        
        /**
         * Get posts by category id
         * @param int $id
         * @return $this
         */
        public function category_id(int $id) {
            $this->filters['cat'] = $id;
            
            return $this;
        }
        
        /**
         * Get posts by category name
         * @param string $name
         * @return $this
         */
        public function category_name(string $name) {
            $this->filters['category_name'] = $name;
            
            return $this;
        }
        
        /**
         * Get posts in multiple categories
         * @param array $ids
         * @return $this
         */
        public function category__and(array $ids) {
            $this->filters['category__and'] = $ids;
            
            return $this;
        }
        
        /**
         * Get posts by category in ids
         * @param array $ids
         * @return $this
         */
        public function category__in(array $ids) {
            $this->filters['category__in'] = $ids;
            
            return $this;
        }
        
        /**
         * Get posts by category not in ids
         * @param array $ids
         * @return $this
         */
        public function category__not_in(array $ids) {
            $this->filters['category__not_in'] = $ids;
            
            return $this;
        }
        
        /**
         * Search posts by tag(s)
         * @param array $params
         * @return mixed
         */
        public function tag(array $params) {
            array_merge($params, $this->filters);
            
            return $this;
        }
        
        /**
         * Get posts by tag id
         * @param int $id
         * @return $this
         */
        public function tag_id(int $id) {
            $this->filters['tag_id'] = $id;
            
            return $this;
        }
        
        /**
         * Get posts with multiple tags
         * @param array $ids
         * @return $this
         */
        public function tag__and(array $ids) {
            $this->filters['tag__and'] = $ids;
            
            return $this;
        }
        
        /**
         * Get posts by tag in ids
         * @param array $ids
         * @return $this
         */
        public function tag__in(array $ids) {
            $this->filters['tag__in'] = $ids;
            
            return $this;
        }
        
        /**
         * Get posts by tag not in ids
         * @param array $ids
         * @return $this
         */
        public function tag__not_in(array $ids) {
            $this->filters['tag__not_in'] = $ids;
            
            return $this;
        }
        
        /**
         * Get posts with multiple tag slugs
         * @param array $slugs
         * @return $this
         */
        public function tag_slug__and(array $slugs) {
            $this->filters['tag_slug__and'] = $slugs;
            
            return $this;
        }
        
        /**
         * Get posts by tag slug in slugs
         * @param array $slugs
         * @return $this
         */
        public function tag_slug__in(array $slugs) {
            $this->filters['tag_slug__in'] = $slugs;
            
            return $this;
        }
        
        /**
         * Search posts by taxonomy(ies)
         * @param array $params
         * @return mixed
         */
        public function taxonomy(array $params) {
            array_merge($params, $this->filters);
            
            return $this;
        }
        
        /**
         * The logical relationship between each inner taxonomy array when there is more than one.
         * @param string $relation
         * @return $this
         */
        public function tax_relation(string $relation = 'AND') {
            if (!isset($this->filters['tax_query'])) {
                $this->filters['tax_query'] = [];
            }
            
            $this->filters['tax_query']['relation'] = $relation;
            
            return $this;
        }
        
        /**
         * Set taxonomy
         * @param string $taxonomy
         * @return $this
         */
        public function tax_name(string $taxonomy) {
            if (!isset($this->filters['tax_query'])) {
                $this->filters['tax_query'] = [];
            }
            
            $this->filters['tax_query'][]['taxonomy'] = $taxonomy;
            
            return $this;
        }
        
        /**
         * Set taxonomy search field
         * @param string $field
         * @param int    $index
         * @return $this
         */
        public function tax_field(string $field = 'term_id', int $index = 0) {
            if (!isset($this->filters['tax_query'])) {
                $this->filters['tax_query'] = [];
            }
            
            $this->filters['tax_query'][$index]['field'] = $field;
            
            return $this;
        }
        
        /**
         * Set taxonomy search terms
         * @param array $terms
         * @param int   $index
         * @return $this
         */
        public function tax_terms(array $terms, int $index = 0) {
            if (!isset($this->filters['tax_query'])) {
                $this->filters['tax_query'] = [];
            }
            
            $this->filters['tax_query'][$index]['terms'] = $terms;
            
            return $this;
        }
        
        /**
         * Whether or not to include children for hierarchical taxonomies.
         * @param bool $include
         * @param int  $index
         * @return $this
         */
        public function tax_include_children(bool $include = true, int $index = 0) {
            if (!isset($this->filters['tax_query'])) {
                $this->filters['tax_query'] = [];
            }
            
            $this->filters['tax_query'][$index]['include_children'] = $include;
            
            return $this;
        }
        
        /**
         * Operator to test
         * @param string $operator
         * @param int    $index
         * @return $this
         */
        public function tax_operator(string $operator = 'IN', int $index = 0) {
            if (!isset($this->filters['tax_query'])) {
                $this->filters['tax_query'] = [];
            }
            
            $this->filters['tax_query'][$index]['operator'] = $operator;
            
            return $this;
        }
        
        /**
         * Posts order by
         * @param array $order_by
         * @return $this
         */
        public function order_by(array $order_by = ['title' => 'ASC']) {
            if (!isset($this->filters['orderby'])) {
                $this->filters['orderby'] = [];
            }
            
            array_merge($order_by, $this->filters['orderby']);
            
            return $this;
        }
        
        /**
         * Posts order
         * @param string $order
         * @return $this
         */
        public function order(string $order = 'ASC') {
            $this->filters['order'] = $order;
            
            return $this;
        }
    }
