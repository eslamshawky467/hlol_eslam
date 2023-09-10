@props(['title'=>'hlol'])

<div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block">{{ $title }}</h3>
    <div class="row breadcrumbs-top d-inline-block">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">الرئيسيه</a>
                </li>
                {{ $slot }}
                <li class="breadcrumb-item active"><a href="#">{{ $title }}</a>
                </li>
            </ol>
        </div>
    </div>
</div>
