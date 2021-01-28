@include("template.partials._header")
@include("template.partials._navbar")

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12 mb-4">
            <h4>{!! $title ?? "&nbsp;" !!}</h4>
        </div>
        @if(session()->has('err'))
        <div class="col-12 mb-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session()->get('err')  }}</strong>
            </div>
        </div>
        @endif

        @if(session()->has('success'))
            <div class="col-12 mb-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ session()->get('success')  }}</strong>
                </div>

            </div>
        @endif
    </div>
    @yield("container")
</div>


{!! Form::open()->method("delete") !!}
{!! Form::close(); !!}
@include("template.partials.footer")
