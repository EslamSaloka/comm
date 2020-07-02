{{ dd(bcrypt('123')) }}
<section class="about-section">
    <div class="container">
        @include('Content::layout.header_content',['header'=>[$content->header_image,$content->header_text]])
        @include('Content::layout.'.$content->type,['content'=>$content->content])
        @include('Content::layout.footer_content',['footer'=>[$content->footer_image,$content->footer_text]])
    </div>
</section>

