<x-app-layout>
    <main role="main" class="container py-4 mb-5 border-0">
        <x-deals-section :deals="$deals"></x-deals-section>
        <hr>
        <div class="mx-auto">
            <section class="vendor-menu">
                <div class="container">
                    @foreach ($vendorProducts as $product)
                        <div class="row  mt-4 ">
                            <div class="item">
                                <x-menu-card :product="$product"></x-menu-card>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>
</x-app-layout>
