@if ($paginator->hasPages())
    @php
        $endNumbers = $paginator->currentPage() * $paginator->perPage();
        $startNumbers = $endNumbers - $paginator->perPage() + 1;
    @endphp
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                Showing {{ $startNumbers }} to
                {{ $endNumbers }} of
                {{ $paginator->total() }} entries</div>
            entries
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate" style="float: right">
                <ul class="pagination">

                    @if ($paginator->onFirstPage())
                        <li class="paginate_button page-item previous disabled" id="example2_previous">
                            <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0"
                                class="page-link">Previous</a>
                        </li>
                    @else
                        <li class="paginate_button page-item previous" id="example2_previous">
                            <a href="{{ $paginator->previousPageUrl() }}" aria-controls="example2" data-dt-idx="0"
                                tabindex="0" class="page-link">Previous</a>
                        </li>
                    @endif


                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="paginate_button page-item disabled"><a href="#" aria-controls="example2"
                                    data-dt-idx="1" tabindex="0" class="page-link">{{ $element }}</a></li>
                        @endif



                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="example2"
                                            data-dt-idx="1" tabindex="0" class="page-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="paginate_button page-item "><a href="{{ $url }}"
                                            aria-controls="example2" data-dt-idx="1" tabindex="0"
                                            class="page-link">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach


                    @if ($paginator->hasMorePages())
                        <li class="paginate_button page-item next" id="example2_next"><a
                                href="{{ $paginator->nextPageUrl() }}" aria-controls="example2" data-dt-idx="7"
                                tabindex="0" class="page-link">Next</a></li>
                    @else
                        <li class="paginate_button page-item next disabled" id="example2_next"><a href="#"
                                aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif
