<x-app>
    <product-list :products='@json($products)' :categories='@json($categories)'
        :user-role="{{ Auth::user()->roles }}">
    </product-list>
</x-app>
