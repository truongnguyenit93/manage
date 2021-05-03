<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <main class="container-fluid mt-2">
                    <section class="row">
                        <div class="col-md-6 col-lg-8">
                        </div>
                        <div class="col-md-6 col-lg-4">

                            <form action="">
                                <input type="date" name="bday">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </section>
                    <article>
                        <div class="container">
                            <h1 class="display-4 mb-2 text-primary">Simple</h1>
                            <p class="lead text-muted">Simple Admin Dashboard with Bootstrap.</p>
                        </div>
                    </article>
                    
                </main>
            </div>
        </div>
    </div>
    
</x-app-layout>
