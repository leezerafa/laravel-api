@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    API OVERVIEW
                        <?php 

                        if(empty($ApiInfoArray)){
                            echo '<p>No Apis found - <a href="/api-create/">Create API</a></p>';
                        }
                        else{
                            foreach($ApiInfoArray as $Api){

                                echo '<h3>'.$Api['api_title'].'</h3>';
                            
                                if(empty($Api['api_data'])){
                                 echo '<p>No Tables Found - <a href="/api-data-create/">Create Table</a></p>';
                                }else{
                                    ?>
                                    <table>
                                        <tr>
                                            <th>Table Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        @foreach ($Api['api_data'] as $ApiData)
                                            <tr>
                                                <td>{{ $ApiData['api_data_table_name']}}</td>
                                                <td> View | Edit | Delete </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2"><p><a href="/api-data-create/">Add Another Table</a></p></td>
                                        </tr>
                                    </table>
                                <?php
                                } 
                            }
                            echo '<p><a href="/api-create/">Create Another API?</a></p>';
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
