<div id="example1_filter" class="dataTables_filter text-right">
    <form action="{{ route($url) }}" method="GET">
        <label><input type="search" name="search" class="form-control form-control-sm"
                value="{{ request()->has('search') ? request()->get('search') : '' }}" placeholder="Search"
                aria-controls="example1"></label>
    </form>
</div>
