<section x-data="{
    open: false,
    init() {
        this.$watch('open', value => {
            value && this.$refs.closeButton.focus()
            this.toggleOverlay()
        })
        this.toggleOverlay()
    },

    toggleOverlay() {
        document.body.classList[this.open ? 'add' : 'remove']('h-screen', 'overflow-hidden')
    },
    sendDataToLivewire() {
        $wire.submitSidebar(Object.fromEntries(new FormData($refs.form))).then(result => {
            Livewire.emit('updateFromSidebar');
            this.open = false
        });
    }
}" x-cloak @open-sidebar.window="open = $event.detail == 'test'"
    @keydown.escape="open = false" x-init="init()">
    <div x-show.transition.opacity.duration.500="open" @click="open = false"
        class="fixed inset-0 z-50 bg-black bg-opacity-25">
    </div>
    <div class="fixed right-0 top-0 z-50 h-screen w-full max-w-lg transform overflow-hidden bg-gray-100 transition duration-300"
        :class="{ 'translate-x-full': !open }">
        <div>
            <button @click="open = false" x-ref="closeButton" class="mb-2 mt-2">
                Fermer x
            </button>
            <form x-ref="form" @submit.prevent="sendDataToLivewire">

                <label for="name">Nom</label>
                <input type="text" name="name" id="name" value="{{ Arr::get($data, 'name') }}">

                <div>
                    <p>Date de création</p>
                    <label for="minCreatedAt">Entre le </label>
                    <input type="date" name="minCreatedAt" id="minCreatedAt">

                    <label for="maxCreatedAt">et le</label>
                    <input type="date" name="maxCreatedAt" id="maxCreatedAt">
                </div>

                <div>
                    <p>Prix du produit le + chère</p>
                    <label for="minHighestProductPrice">Min </label>
                    <input type="number" name="minHighestProductPrice" id="minHighestProductPrice"
                        value="{{ Arr::get($data, 'minHighestProductPrice') }}">

                    <label for="maxHighestProductPrice">Max </label>
                    <input type="number" name="maxHighestProductPrice" id="maxHighestProductPrice"
                        value="{{ Arr::get($data, 'maxHighestProductPrice') }}">
                </div>

                <button>
                    Appliquer les filtres
                </button>

            </form>
        </div>
    </div>
</section>
