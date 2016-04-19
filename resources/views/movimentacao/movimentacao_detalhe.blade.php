@extends('principal')

@section('mostra')
@foreach ($ativo as $p)
{{$dataatual = $p->data_inicio}}
@endforeach

<script type="text/javascript">
    function busca()
    {
        // pegando o value
        var data_inicio = document.getElementById('data_inicio').value;
        var data_fim = document.getElementById('data_fim').value;
        var placa = document.getElementById('placa').value;
        //chegagem se os campos não estão em branco
        if  (placa == ""){
            alert("A Placa deve ser preenchida!");
        } else{
        document.busca1.submit();
        }
    }
    function nova_movimentacao()
    {
        var placa = "{{$placa}}";        
        var data = document.getElementById('data').value;
        var km = document.getElementById('km').value;
        var combustivel = document.getElementById('combustivel').value;
        var status = document.getElementById('status').value;        
        
        var dataatual ="{{$dataatual}}";
       
      alert(dataatual + "//" + data + "//" + km  + "//" + combustivel + "//" + status);
    }    

</script>

<form name="busca1" method="get" action='/movimentacao_detalhe'>
    <table>
    <tr>
        <td>Data Inicio </td>   
        <td>Data Fim </td>
        <td>Placa </td>            
    </tr>
    <tr>
        <td><input type="text" id='data_inicio' name='data_inicio' value=""></td>
        <td><input type="text" id='data_fim' name='data_fim' value=""></td>
        <td><input type="text" id='placa' name='placa' value="{{$placa}}"></td>
        <td><input type="button" value='Buscar Novo'onclick="busca()"></input> </td>
    </tr>
    </table>
</form>
    

<table border='1'>
     
        <tr>
            <td> Placa</td>
            <td> Status</td>
            <td> Data Inicial</td>
            <td> Hora Inicial</td>
            <td> Data Final</td>
            <td> Hora Final</td>
            <td> KM  </td>
            <td> Combustivel  </td>
            <td> Módulo       </td>
        </tr>
      
        @foreach($mov as $mov)
        
       
        <tr>
            <td>{{$mov->placa}}</td>    
            <td><?php echo ($mov->status->nome);  ?></td>
            <td><?php echo  date('d-m-Y', strtotime($mov->data_inicio));  ?></td>
            <td><?php echo date('H:i', strtotime($mov->data_inicio));?></td>
            <td>
                <?php if (!empty($mov->data_fim)){
                echo date('d-m-Y', strtotime($mov->data_fim));}
                ?>
            </td>
            <td>
                <?php if (!empty($mov->data_fim)){
                echo date('H:i', strtotime($mov->data_fim));}
                ?>
            
            </td>

            <td>{{$mov->km}}</td>   
            <td>{{$mov->combustivel}}</td>
            <td>{{$mov->modulo}}</td>   
             
        </tr>
        
   
        @endforeach
</table> 
<form name="novo" method="get" action='/movimentacao_novo'>
 <input type="text" id='placa' name='placa' value="{{$placa}}"   
    <div id="menu2">
        
    <ul>
        @foreach($ativo as $ativo)
        {{$dataatual = $ativo->data_inicio}}<br>
        {{$dataatual}}
        
            
        <li>Data <input type="text" id='data' name='data' value="{{date('d-m-Y', strtotime($ativo->data_inicio))}}"</li>
        <li>Hora <input type="text" id='hora' name='hora' ></li>
        <li>KM <input type="text" id='km' name='km' ></li>
        
        <li>Combustivel
            <select id="combustivel" name="combustivel">
                <option value=""></option>
                <option value="0">Reserva</option>
                <option value="1">1/4</option>
                <option value="2">2/4</option>
                <option value="3">3/4</option>
                <option value="4">4/4</option>
            </select>
        </li>
        <li>Status 
            <select id='status' name='status' >
                <option value=""></option>
                @foreach ($status as $p)
                <option value="{{$p->id}}">{{$p->nome}}</option>
                @endforeach
            </select>
        </li>
        @endforeach
    </ul>
    </div>
    
        
    <input type="button" value='Incluir Movimentação'onclick="nova_movimentacao()"></input>
    
    
</form>

 
@stop