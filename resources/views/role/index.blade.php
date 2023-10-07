<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All User') }}
        </h2>
    </x-slot>

    
    <!DOCTYPE html>
      <html lang="en" class="antialiased">

      <head>
        
        <style>
          /*Overrides for Tailwind CSS */

          /*Form fields*/
          .dataTables_wrapper select,
          .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            /*text-gray-700*/
            padding-left: 1rem;
            /*pl-4*/
            padding-right: 1rem;
            /*pl-4*/
            padding-top: .5rem;
            /*pl-2*/
            padding-bottom: .5rem;
            /*pl-2*/
            line-height: 1.25;
            /*leading-tight*/
            border-width: 2px;
            /*border-2*/
            border-radius: .25rem;
            border-color: #edf2f7;
            /*border-gray-200*/
            background-color: #edf2f7;
            /*bg-gray-200*/
          }

          /*Row Hover*/
          table.dataTable.hover tbody tr:hover,
          table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;
            /*bg-indigo-100*/
          }

          /*Pagination Buttons*/
          .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            border: 1px solid transparent;
            /*border border-transparent*/
          }

          /*Pagination Buttons - Current selected */
          .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
          }

          /*Pagination Buttons - Hover */
          .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
          }

          /*Add padding to bottom border */
          table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            /*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
          }

          /*Change colour of responsive icon*/
          table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
          table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #667eea !important;
            /*bg-indigo-500*/
          }
        </style>



      </head>

      <body class="bg-gray-100 text-gray-900 tracking-wider leading-normal">


        <!--Container-->
        <div class="w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
          <div class="my-5">
            @can('create role')
            <a href="{{route('add.role')}}" class="  bg-green-600 text-white rounded-sm p-3">Add Role</a>
            @endcan
          </div>

          <!--Title-->
        

          <!--Card-->
          <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
              <thead>
                <tr>
                    <th>SL</th>
                    <th>Role</th>
                    <th>Permission</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($roles->count() > 0)
                @foreach ($roles as $role)
                <tr>
                  <td>{{$role->id}}</td>
                  <td>{{$role->name}}</td>
                  <td>
                    <div class="flex gap-2 flex-wrap text-center">
                        @foreach ($role->permissions as $item)
                        <div class="bg-green-700 w-auto text-white p-1 rounded">{{$item->name}}</div>
                        @endforeach
                    </div>
                  </td>
                  <td>
                    @can('edit role')
                      
                    <a href="{{route('edit.role',$role->id)}}" class=""><i class="fa-regular fa-pen-to-square"></i></a>
                    @endcan
                    @can('delete role')
                      
                    <a href="{{route('delete.role',$role->id)}}" class=""><i class="fa-solid fa-trash"></i></a>
                    @endcan
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td> Nothing found</td>
                </tr>
                @endif

                
                <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->
              </tbody>

            </table>

          </div>
          <!--/Card-->


        </div>
        <!--/container-->


      </body>

      </html>
</x-app-layout>