<x-layout page="Registro ToDo">

    <x-slot:btn>
        <a href="{{route('login')}}" class="btn btn-primary">
            Já possui conta? Faça seu login
        </a>
    </x-slot:btn>


    <section id="task_section">
        <h1>Registrar-se</h1>

        <form method="POST" action="{{ route('user.register_action') }}">
            @csrf  <!--Token autenticação -->

            @if($errors->any())
                <ul class="alert alert-error">

                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif

            <x-form.text_input
                name="name"
                label="Seu nome"
                placeholder="Seu nome"
            />

            <x-form.text_input
                type="email"
                name="email"
                label="Seu email"
                placeholder="Seu email"
                required="required"
            />

            <x-form.text_input
              type="password"
              name="password"
              label="Sua senha"
              placeholder="Digite sua senha"
              required="required"
            />

            <x-form.text_input
              type="password"
              name="password_confirmation"
              label="Confirme sua senha"
              placeholder="Confirme sua senha"
              required="required"
            />

            <x-form.form_button resetTxt="Limpar" submitTxt="Registrar-se"/>
        </form>
    </section>

</x-layout>
