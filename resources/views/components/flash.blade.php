@if(session()->has('success'))
    <div x-data="{show:true}"
         x-init="setTimeout(()=>show=false,4000)"
         x-show="show"
         class="fixed text-black py-2 px-4 rounded-xl bottom-3 right-3 text-sm font-bold"
         style="border: 2px solid black">
        <p>{{session('success')}}</p>
    </div>
@endif
