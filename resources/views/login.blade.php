<x-layout page="Login ToDo">

    <x-slot:btn>
        <a href="{{route('register')}}" class="btn btn-primary">
            Já possui conta? Registre-se
        </a>
    </x-slot:btn>

    <section id="task_section">
        <a href="{{route('login')}}">
            <img src="/assets/images/logo3.png" alt="data-fim">

        </a>

        <h3 style="text-align:center">Autenticação</h3>

        <form method="POST" action="{{ route('user.login_action') }}">
            @csrf  <!--Token autenticação -->

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


            <x-form.form_button resetTxt="Limpar" submitTxt="Logar-se"/>
        </form>
    </section>



</x-layout>
