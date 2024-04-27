@include('layouts.app')
  <div>
       <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
           <div class="container mx-auto px-6 py-8">

               
               <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>                
 
           </div>
       </main>
   </div>
</div>

