
<x-layout>

    <x-slot:btn>
        <a href="{{ route('task.create') }}" class="btn btn-primary">
            Criar Tarefa
        </a>

        <a href="{{ route('logout') }}" class="btn btn-primary">
            Sair do ToDo
        </a>
    </x-slot:btn>

    <section class="graph">
        <div class="graph_header">
            <h2> Progresso do Dia - {{--$AuthUser->name--}}</h2>
            <div class="graph_header_line"></div>
            <div class="graph_header_date">

                <a href="{{route('home',['date' => $date_prev_button])}}">
                    <img src="/assets/images/icon-prev.png" alt="data">
                </a>
                    {{$date_as_string}}
                <a href="{{route('home',['date'=> $date_next_button])}}">
                     <img src="/assets/images/icon-next.png" alt="data-fim">
                </a>

            </div>
        </div>

        {{-- <div class="graph_header_subtitle"> Tarefas: <b> 3/6 </b> </div> --}}
        <div class="graph_header_subtitle">
            Tarefas: <b>{{ $tasks_count - $undone_tasks_count }}/{{ $tasks_count }}</b>
            </div>

        <div class="graph_placeholder">
        </div>

        <div class="tasks_left_footer">
            <img src="/assets/images/icon-info.png" />
            Restam &nbsp; <b> {{ ($tasks_count) - ($tasks_count - $undone_tasks_count) }} </b> &nbsp; tarefas para {{$date_as_string}}.
        </div>


    </section>

    <section class="list">
        <div class="list_header">
            <select class="list_header_select" onChange="changeTaskStatusFilter(this)">
                <option value="all_tasks">Todas as tarefas</option>
                <option value="task_pending">Tarefas pendentes</option>
                <option value="task_done">Tarefas Realizadas</option>
            </select>
        </div>

        <div class="task_list">

            @foreach($tasks as $task)
                <x-task :data=$task />
            @endforeach

        </div>

    </section>

    <script>
        function changeTaskStatusFilter(element) {
            let selectedOption = element.value;

            // Obtém todos os elementos de tarefa
            let tasks = document.querySelectorAll('.task');

            if (selectedOption === 'task_pending') {
                tasks.forEach(function(task) {
                    if (task.classList.contains('task_done')) {
                        task.style.display = 'none';
                    } else {
                        task.style.display = 'flex';
                    }
                });
            } else if (selectedOption === 'task_done') {
                tasks.forEach(function(task) {
                    if (task.classList.contains('task_pending')) {
                        task.style.display = 'none';
                    } else {
                        task.style.display = 'flex';
                    }
                });
            } else {
                // Caso contrário, mostra todas as tarefas
                tasks.forEach(function(task) {
                    task.style.display = 'flex';
                });
            }
        }
    </script>

    {{-- ----------------------------------- --}}
    <script>
        async function taskUpate(element){
           let status = element.checked;
           let taskId = element.dataset.id;
           let url = '{{route('task.update')}}';
           let rawResult = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'accept': 'application/json',
                },
                body: JSON.stringify({status, taskId, _token: '{{ csrf_token() }}'})
           });
           result = await rawResult.json();
           if(result.success){
                alert('Task Atualizada com Sucesso!');
                location.reload();
           } else {
               // element.checked = !status;
           }
        }
    </script>

</x-layout>


{{--
     EXPLICAÇÃO DO CÓDIGO JAVASCRIPT ACIMA
 Este código JavaScript define uma função assíncrona chamada taskUpdate, que é acionada quando um elemento é alterado (checkbox). Vamos analisar o código linha por linha:

async function taskUpdate(element) { - Define a função assíncrona chamada taskUpdate com um parâmetro element, que representa o elemento que acionou o evento.

let status = element.checked; - Obtém o valor booleano do atributo checked do elemento, indicando se está marcado ou não.

let taskId = element.dataset.id; - Obtém o valor do atributo data-id do elemento usando dataset.id. Essa linha provavelmente está obtendo o ID da tarefa associada ao elemento.

let rawResult = await fetch(url, { - Faz uma requisição HTTP usando a função fetch. A URL para a requisição não está especificada no código fornecido e deve ser definida anteriormente. O resultado da requisição é atribuído à variável rawResult.

method: 'POST', - Especifica que a requisição será do tipo POST.

'Content-type': 'application/json', - Define o cabeçalho Content-type da requisição como application/json, indicando que o corpo da requisição será JSON.

'accept': 'application/json', - Define o cabeçalho accept da requisição como application/json, indicando que o cliente aceita uma resposta JSON.

body: JSON.stringify({status, taskId}) - Define o corpo da requisição como uma string JSON, criada usando a função JSON.stringify(). O objeto JSON contém as propriedades status e taskId, que são os valores obtidos anteriormente.

result = await rawResult.json(); - Aguarda a resposta da requisição e a converte em um objeto JavaScript usando o método json() do objeto rawResult. O resultado é atribuído à variável result.

console.log(result); - Exibe o objeto result no console do navegador.

Em resumo, essa função JavaScript recebe um elemento (provavelmente um checkbox) como parâmetro, obtém seu status e ID e envia esses dados para um servidor usando uma requisição POST. O resultado da requisição é exibido no console do navegador.

--}}
