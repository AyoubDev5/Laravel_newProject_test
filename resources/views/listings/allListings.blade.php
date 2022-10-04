<x-layout>
    @include('particial._hero')
    @include('particial._search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @if(count($listings)==0)
            <h1>No listings here</h1>
        @else
            @foreach ($listings as $list)
                <x-listing-card :listing="$list" />
            @endforeach
        @endif

    </div>
    <div class="mt-6 p-4">
        {{$listings->links()}}
    </div>
</x-layout>






