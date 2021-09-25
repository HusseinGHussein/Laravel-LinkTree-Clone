<x-guest-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @foreach ($user->links as $link)
                <div style="background-color: {{ $user->background_color }}">
                    <a href="{{ $link->link }}"
                        data-link-id="{{ $link->id }}"
                        class="block p-4 mb-4 text-3xl text-center rounded user-link hover:underline"
                        target="_blank"
                        rel="nofollow"
                        style="border: 2px solid {{ $user->text_color }}; color: {{ $user->text_color }}">
                        {{ $link->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            const userLinks = document.querySelectorAll('.user-link')

            userLinks.forEach(function(el){
                el.addEventListener('click', function () {
                    var linkId = this.getAttribute('data-link-id');

                    axios.post('/visits/' + linkId)
                        .then(response => console.log('resposne: ', response))
                        .catch(error => console.log('error: ', error))
                });
            });
        </script>
    @endpush

</x-guest-layout>