@extends('layouts.app')

@section('title', 'Funcionalidades')
@section('page-title', 'features')

@section('content')

    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">
            <div class="toolbar d-flex flex-stack flex-wrap mb-5 mb-lg-7" id="kt_toolbar">
                <div class="page-title d-flex flex-column py-1">

                    <h1 class="d-flex align-items-center my-1">
                        <span class="text-gray-900 fw-bold fs-1">Funcionalidades</span>
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>

                        <li class="breadcrumb-item text-gray-900">Funcionalidades</li>
                    </ul>
                </div>

            </div>
            <div class="post" id="kt_post">
                <div class="card">
                    <div class="card-body p-lg-17">

                        <div class="mb-18">
                            <div class="mb-10">

                                @include('layouts.components.banner', [
                                    'title' => 'Funcionalidades',
                                    'description' =>
                                        'Descubra todos os recursos que tornam o DevsAPI a ferramenta mais completa para desenvolvedores.',
                                ])

                            </div>
                        </div>

                        <div class="d-flex flex-column flex-lg-row">
                            <!--begin::Sidebar-->
                            <div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 me-lg-20">
                                <!--begin::Busca-->
                                <div class="mb-16">
                                    <h4 class="text-gray-900 mb-7">Buscar Funcionalidade</h4>
                                    <div class="position-relative">
                                        <i
                                            class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" class="form-control form-control-solid ps-10" name="search"
                                            placeholder="Buscar..." />
                                    </div>
                                </div>
                                <!--end::Busca-->

                                <!--begin::Categorias-->
                                <div class="mb-15">
                                    <h4 class="text-gray-900 mb-7">Categorias</h4>
                                    <div class="menu menu-rounded menu-column menu-title-gray-700 menu-state-title-primary menu-active-bg-light-primary fw-semibold nav nav-tabs border-0"
                                        role="tablist">

                                        <!-- Hidden tab trigger for search -->
                                        <a class="menu-link py-3 d-none" data-bs-toggle="tab" href="#tab-search"
                                            id="tab-search-link"></a>

                                        <div class="menu-item">
                                            <a class="menu-link py-3 active" data-bs-toggle="tab" href="#tab-overview"
                                                role="tab">
                                                Visão Geral
                                            </a>
                                        </div>

                                        <div class="menu-item mb-1">
                                            <a class="menu-link py-3" data-bs-toggle="tab" href="#tab-modulos"
                                                role="tab">
                                                🚀 Geração de Módulos
                                            </a>
                                        </div>

                                        <div class="menu-item mb-1">
                                            <a class="menu-link py-3" data-bs-toggle="tab" href="#tab-api" role="tab">
                                                🔗 Criação de API
                                            </a>
                                        </div>

                                        <div class="menu-item mb-1">
                                            <a class="menu-link py-3" data-bs-toggle="tab" href="#tab-permissoes"
                                                role="tab">
                                                🛡️ Controle de Permissões
                                            </a>
                                        </div>

                                        <div class="menu-item mb-1">
                                            <a class="menu-link py-3" data-bs-toggle="tab" href="#tab-autenticacao"
                                                role="tab">
                                                🔐 Autenticação Segura
                                            </a>
                                        </div>

                                        <div class="menu-item mb-1">
                                            <a class="menu-link py-3" data-bs-toggle="tab" href="#tab-google"
                                                role="tab">
                                                ⚙️ Integrações Google
                                            </a>
                                        </div>

                                    </div>
                                </div>
                                <!--end::Categorias-->


                            </div>
                            <!--end::Sidebar-->

                            <!--begin::Conteúdo-->
                            <div class="flex-lg-row-fluid tab-content">

                                <!-- 🔍 Resultados da Busca -->
                                <div class="tab-pane fade" id="tab-search" role="tabpanel">
                                    <h3 class="fs-2x text-gray-800 fw-bold mb-4">🔍 Resultados da busca</h3>
                                    <div id="search-results-content" class="fs-5 text-gray-600">
                                        <p>Digite algo para buscar funcionalidades...</p>
                                    </div>
                                </div>

                                <!-- 🎨 Customização -->
                                <div class="tab-pane fade show active" id="tab-overview" role="tabpanel">

                                    <div class="mb-13">
                                        <div class="mb-15">
                                            <h4 class="fs-2x text-gray-800 w-bolder mb-6">Funcionalidades do DevsAPI
                                            </h4>
                                            <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                                O DevsAPI é uma plataforma que automatiza o desenvolvimento em
                                                Laravel,
                                                criando módulos completos com poucos cliques.
                                                Tudo é padronizado, seguro e pronto para personalização.
                                            </p>
                                        </div>

                                        <!--begin::Feature item-->
                                        <div class="mb-15">
                                            <h3 class="text-gray-800 w-bolder mb-4">
                                                <a data-bs-toggle="tab" href="#tab-modulos" role="tab"
                                                    class="text-gray-800 text-hover-primary">
                                                    🚀 Criação Automática de Módulos
                                                </a>
                                            </h3>
                                            <div class="fs-4 text-gray-600 ps-10">
                                                Defina os campos e relacionamentos, e o DevsAPI faz o resto.
                                                Em poucos segundos, ele gera todo o backend do seu módulo, pronto
                                                para uso
                                                e integrado via endpoint.
                                                Um painel completo de cadastro e gestão, padronizado e alinhado às
                                                melhores
                                                práticas.
                                            </div>
                                            <div class="separator separator-dashed my-6"></div>
                                        </div>

                                        <div class="mb-15">
                                            <h3 class="text-gray-800 w-bolder mb-4">
                                                <a data-bs-toggle="tab" href="#tab-api" role="tab"
                                                    class="text-gray-800 text-hover-primary">
                                                    🔗 API Padrão REST Integrada
                                                </a>
                                            </h3>
                                            <div class="fs-4 text-gray-600 ps-10">
                                                Cada módulo já vem com endpoints prontos, autenticação por token,
                                                filtros e
                                                paginação.
                                                Ideal para integrar com sites, aplicativos ou outros sistemas sem
                                                complicação.
                                            </div>
                                            <div class="separator separator-dashed my-6"></div>
                                        </div>

                                        <div class="mb-15">
                                            <h3 class="text-gray-800 w-bolder mb-4">
                                                <a data-bs-toggle="tab" href="#tab-permissoes" role="tab"
                                                    class="text-gray-800 text-hover-primary">
                                                    🛡️ Sistema de Permissões Inteligente
                                                </a>
                                            </h3>
                                            <div class="fs-4 text-gray-600 ps-10">
                                                O <strong>DevsAPI</strong> permite definir e aplicar permissões
                                                diretamente
                                                no front-end,
                                                integradas ao login e aos tokens de acesso. Flexível, leve e pronta
                                                para
                                                expansão no backend.
                                            </div>
                                            <div class="separator separator-dashed my-6"></div>
                                        </div>

                                        <div class="mb-15">
                                            <h3 class="text-gray-800 w-bolder mb-4">
                                                <a data-bs-toggle="tab" href="#tab-autenticacao" role="tab"
                                                    class="text-gray-800 text-hover-primary">
                                                    🔐 Autenticação Segura
                                                </a>
                                            </h3>
                                            <div class="fs-4 text-gray-600 ps-10">
                                                O ambiente client/ é totalmente protegido por autenticação baseada
                                                em
                                                tokens.
                                                Cada requisição exige um token de credencial e o slug do projeto,
                                                garantindo
                                                que apenas sistemas autorizados acessem os endpoints gerados.
                                                Segurança e isolamento total entre credenciais, projetos e
                                                ambientes.
                                            </div>
                                            <div class="separator separator-dashed my-6"></div>
                                        </div>

                                        <div class="mb-15">
                                            <h3 class="text-gray-800 w-bolder mb-4">
                                                <a data-bs-toggle="tab" href="#tab-google" role="tab"
                                                    class="text-gray-800 text-hover-primary">
                                                    ⚙️ Integrações com Google
                                                </a>
                                            </h3>
                                            <div class="fs-4 text-gray-600 ps-10">
                                                Conecte-se ao Google Calendar, Meet e Drive direto pelo DevsAPI.
                                                Crie reuniões automáticas, sincronize eventos e mantenha tudo em um
                                                só
                                                lugar, sem precisar sair do seu sistema.
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- 🚀 Criação Automática de Módulos -->
                                <div class="tab-pane fade mb-20" id="tab-modulos" role="tabpanel">
                                    <h3 class="fs-2x text-gray-800 fw-bold mb-4">🚀 Criação Automática de Módulos
                                    </h3>
                                    <p class="fs-4 text-gray-600">
                                        O <strong>DevsAPI</strong> transforma a criação de módulos em um processo
                                        rápido,
                                        padronizado e totalmente automatizado.
                                        Você define os campos, tipos de dados, validações e relacionamentos — por
                                        exemplo,
                                        um módulo <em>“Aluno”</em> com campos como nome, e-mail e telefone,
                                        vinculado ao
                                        módulo <em>“Turma”</em> —
                                        e o sistema cuida de todo o restante.

                                        <br><br>
                                        Com apenas um clique, o DevsAPI gera automaticamente:
                                        <br><br>
                                        • <strong>Migration</strong> completa com todos os campos e relacionamentos
                                        configurados;<br>
                                        • <strong>Model</strong> com <code>fillable</code> dinâmico e métodos de
                                        relacionamento (<code>hasOne</code>, <code>belongsTo</code>,
                                        <code>hasMany</code>,
                                        etc.);<br>
                                        • <strong>Request</strong> com regras de validação automáticas e mensagens
                                        personalizadas;<br>
                                        • <strong>Controller</strong> REST com rotas prontas (<code>index</code>,
                                        <code>store</code>, <code>update</code>, <code>destroy</code>,
                                        <code>restore</code>
                                        e <code>delete</code>);<br>
                                        • <strong>Menu</strong> e <strong>permissões</strong> configuráveis para
                                        acesso
                                        rápido e organizado.<br><br>

                                        Além disso, cada módulo segue o mesmo padrão estrutural do Laravel 11+,
                                        mantendo
                                        consistência entre a API, o Front e o Banco de Dados.
                                        Tudo é gerado a partir de arquivos <code>.stub</code> dinâmicos, permitindo
                                        personalização e reuso sem duplicar código.

                                        <br><br>
                                        Em poucos segundos, você tem um módulo completo, funcional e escalável —
                                        pronto para
                                        rodar em produção no seu front-end.
                                    </p>
                                </div>


                                <!-- 🔗 API Padrão REST Integrada -->
                                <div class="tab-pane fade mb-20" id="tab-api" role="tabpanel">
                                    <h3 class="fs-2x text-gray-800 fw-bold mb-4">🔗 API Padrão REST Integrada</h3>
                                    <p class="fs-4 text-gray-600">
                                        Cada módulo criado no <strong>DevsAPI</strong> já vem com uma <strong>API
                                            funcional,
                                            segura e documentada</strong>.
                                        Todos os endpoints são gerados automaticamente e prontos para integração com
                                        qualquer aplicação,
                                        garantindo produtividade e padronização desde o primeiro uso.

                                        <br><br>
                                        Exemplo:<br>
                                        Ao criar o módulo <em>“Aluno”</em>, o DevsAPI gera automaticamente endpoints
                                        como:
                                        <br><br>
                                        • <strong>GET</strong> /api/<code>{client}</code>/aluno — lista registros
                                        com
                                        paginação e filtros;<br>
                                        • <strong>POST</strong> /api/<code>{client}</code>/aluno — cria um novo
                                        registro;<br>
                                        • <strong>PUT</strong> /api/<code>{client}</code>/aluno/{id} — atualiza
                                        dados
                                        existentes;<br>
                                        • <strong>DELETE</strong> /api/<code>{client}</code>/aluno/{id} — realiza
                                        exclusão
                                        lógica (soft
                                        delete);<br>
                                        • <strong>PATCH</strong> /api/<code>{client}</code>/aluno/{id}/restore —
                                        restaura
                                        registros
                                        removidos.<br><br>

                                        Todos os endpoints incluem <strong>autenticação via token</strong> e suporte
                                        a
                                        <strong>filtros dinâmicos</strong>
                                        (<code>?nome=João&amp;active=1</code>), oferecendo flexibilidade total para
                                        consumo
                                        em qualquer front-end,
                                        aplicativo mobile ou integração externa.
                                    </p>
                                </div>

                                <!-- 🛡️ Sistema de Permissões Inteligente -->
                                <div class="tab-pane fade mb-20" id="tab-permissoes" role="tabpanel">
                                    <h3 class="fs-2x text-gray-800 fw-bold mb-4">🛡️ Sistema de Permissões
                                        Inteligente</h3>
                                    <p class="fs-4 text-gray-600">
                                        O <strong>DevsAPI</strong> foi projetado para oferecer flexibilidade total
                                        no
                                        controle de acesso,
                                        permitindo que cada projeto defina suas próprias regras de permissão sem
                                        depender de
                                        camadas fixas do backend.
                                        As permissões podem ser aplicadas diretamente no <strong>front-end</strong>,
                                        integradas ao sistema de login
                                        ou conectadas a provedores externos de autenticação (como OAuth, JWT, ou
                                        Google
                                        Workspace).

                                        <br><br>
                                        Com isso, cada aplicação gerada pode adaptar o modelo de segurança às suas
                                        necessidades — seja um painel administrativo,
                                        um portal de membros ou uma API pública controlada. As regras são facilmente
                                        configuradas e aplicadas de forma dinâmica,
                                        mantendo a segurança sem comprometer a performance.

                                        <br><br>
                                        • Definição granular de acesso por módulo, credencial ou usuário;<br>
                                        • Integração direta com o sistema de tokens e autenticação do DevsAPI;<br>
                                        • Implementação via front-end, middleware próprio ou camada intermediária
                                        personalizada;<br>
                                        • Suporte a diferentes perfis (admin, colaborador, visitante, etc.);<br>
                                        • Estrutura preparada para futura expansão no backend com cache e logs de
                                        permissão.<br><br>

                                        Com o <strong>DevsAPI</strong>, o controle de acesso é simples, transparente
                                        e
                                        moldado às necessidades de cada projeto —
                                        unindo liberdade de desenvolvimento e segurança em um único fluxo.
                                    </p>
                                </div>


                                <!-- 🔐 Autenticação Segura -->
                                <div class="tab-pane fade mb-20" id="tab-autenticacao" role="tabpanel">
                                    <h3 class="fs-2x text-gray-800 fw-bold mb-4">🔐 Autenticação Segura</h3>
                                    <p class="fs-4 text-gray-600">
                                        O ambiente <strong>client/</strong> é protegido por um sistema de
                                        autenticação
                                        baseado em <strong>tokens</strong>,
                                        garantindo que apenas credenciais e projetos autorizados acessem os
                                        endpoints
                                        gerados pelo DevsAPI.
                                        Essa camada de segurança assegura isolamento total entre clientes, ambientes
                                        e
                                        tokens utilizados.

                                        <br><br>
                                        Cada requisição deve conter o <strong>token da credencial</strong> e o
                                        <strong>slug
                                            do projeto</strong>
                                        no cabeçalho (<em>header</em>), permitindo a validação completa da origem da
                                        chamada:

                                        <br><br>
                                        <code>Authorization: Bearer {token_credential}</code><br>
                                        <code>X-Project-Slug: {slug_project}</code>

                                        <br><br>
                                        • Validação cruzada entre credencial e projeto;<br>
                                        • Isolamento total entre ambientes e tokens;<br>
                                        • Bloqueio imediato de tokens inválidos ou expirados;<br>
                                        • Rastreamento completo de cada requisição;<br>
                                        • Compatível com API REST e integrações externas.<br><br>

                                        Segurança, controle e rastreabilidade integradas de forma simples e
                                        transparente ao
                                        seu fluxo de desenvolvimento.
                                    </p>
                                </div>

                                <!-- ⚙️ Integrações com Google -->
                                <div class="tab-pane fade mb-20" id="tab-google" role="tabpanel">
                                    <h3 class="fs-2x text-gray-800 fw-bold mb-4">⚙️ Integrações com Google</h3>
                                    <p class="fs-4 text-gray-600">
                                        O <strong>DevsAPI</strong> se conecta diretamente aos principais serviços do
                                        <strong>Google</strong>,
                                        permitindo que seus módulos interajam de forma automática e inteligente com
                                        ferramentas como
                                        <strong>Calendar</strong>, <strong>Meet</strong> e <strong>Drive</strong>.
                                        Essa integração facilita o agendamento de eventos, o compartilhamento de
                                        arquivos e
                                        a sincronização de informações
                                        sem a necessidade de qualquer configuração manual.

                                        <br><br>
                                        Com poucos cliques, o DevsAPI é capaz de criar conexões seguras e dinâmicas
                                        entre o
                                        seu sistema e o ecossistema Google,
                                        automatizando processos que antes exigiam integrações complexas.
                                        Tudo é feito por meio de tokens validados e APIs oficiais, garantindo
                                        conformidade e
                                        total rastreabilidade de cada operação.

                                        <br><br>
                                        Exemplo de uso:<br>
                                        • Criar automaticamente uma reunião no <strong>Google Meet</strong> ao
                                        registrar um
                                        evento ou agendamento;<br>
                                        • Enviar e organizar arquivos de relatórios, atas ou documentos no
                                        <strong>Google
                                            Drive</strong> do projeto;<br>
                                        • Sincronizar compromissos e lembretes no <strong>Google Calendar</strong>
                                        da
                                        organização;<br>
                                        • Compartilhar pastas, links e gravações de reuniões com os usuários
                                        autorizados;<br>
                                        • Centralizar notificações e atualizações em um único ambiente
                                        conectado.<br><br>

                                        Com o <strong>DevsAPI</strong>, a integração com os serviços do Google deixa
                                        de ser
                                        um desafio técnico e se torna
                                        uma extensão natural do seu sistema — simples, segura e totalmente
                                        automatizada.
                                    </p>
                                </div>


                            </div>
                            <!--end::Conteúdo-->
                        </div>

                        <!--begin::Script-->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelectorAll('[data-bs-toggle="tab"]').forEach(trigger => {
                                    trigger.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        const target = this.getAttribute('href');
                                        const originalTrigger = document.querySelector(
                                            `[href="${target}"][role="tab"]`);

                                        if (originalTrigger) {
                                            const tab = new bootstrap.Tab(originalTrigger);
                                            tab.show();

                                            // rola até o container principal
                                            const content = document.getElementById('content-features');
                                            if (content) {
                                                const y = content.getBoundingClientRect().top + window.scrollY -
                                                    80; // ajuste fino (-80px)
                                                window.scrollTo({
                                                    top: y,
                                                    behavior: 'smooth'
                                                });
                                            }
                                        }
                                    });
                                });
                            });
                        </script>



                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const input = document.querySelector('input[name="search"]');
                                const link = document.getElementById('tab-search-link');
                                const results = document.getElementById('search-results-content');
                                let timeout = null;

                                input.addEventListener('input', () => {
                                    clearTimeout(timeout);
                                    timeout = setTimeout(() => {
                                        const term = input.value.trim();

                                        if (term.length > 2) {
                                            const tab = new bootstrap.Tab(link);
                                            tab.show();

                                            results.innerHTML = `
                                                <p class="text-gray-600 mb-0">
                                                    Exibindo resultados para: <strong>${term}</strong>
                                                </p>
                                                <ul class="mt-3">
                                                    <li>🚀 <strong>Geração de Módulos</strong> — automatize a criação completa do CRUD.</li>
                                                    <li>🔗 <strong>API REST</strong> — endpoints prontos e documentados.</li>
                                                    <li>🛡️ <strong>Permissões</strong> — controle de acesso avançado.</li>
                                                    <li>⚙️ <strong>Integrações Google</strong> — sincronização com Calendar e Drive.</li>
                                                </ul>
                                            `;
                                        } else {
                                            results.innerHTML = `<p>Digite algo para buscar funcionalidades...</p>`;
                                        }
                                    }, 250); // ⏳ pequeno atraso de 250ms para digitação
                                });
                            });
                        </script>

                        <!--end::Script-->










                        {{-- <div class="mb-18">
                            <div class="text-center mb-12">
                                <h3 class="fs-2hx text-gray-900 mb-5">Our Great Team</h3>
                                <div class="fs-5 text-muted fw-semibold">It’s no doubt that when a development takes longer
                                    to complete, additional costs to
                                    <br />integrate and test each extra feature creeps up and haunts most of us.
                                </div>
                            </div>
                            <div class="tns tns-default mb-10">
                                <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false"
                                    data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000"
                                    data-tns-controls="true" data-tns-nav="false" data-tns-items="1"
                                    data-tns-center="false" data-tns-dots="false"
                                    data-tns-prev-button="#kt_team_slider_prev"
                                    data-tns-next-button="#kt_team_slider_next"
                                    data-tns-responsive="{1200: {items: 3}, 992: {items: 2}}">
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-1.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Paul
                                                Miles</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Development Lead</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-2.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Melisa
                                                Marcus</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Creative Director</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-5.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">David
                                                Nilson</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Python Expert</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-20.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Anne
                                                Clarc</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Project Manager</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-23.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Ricky
                                                Hunt</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Art Director</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-12.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Alice
                                                Wayde</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">Marketing Manager</div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                            style="background-image:url('assets/media/avatars/300-9.jpg')"></div>
                                        <div class="mb-0">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-3">Carles
                                                Puyol</a>
                                            <div class="text-muted fs-6 fw-semibold mt-1">QA Managers</div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev">
                                    <i class="ki-duotone ki-left fs-3x"></i>
                                </button>
                                <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next">
                                    <i class="ki-duotone ki-right fs-3x"></i>
                                </button>
                            </div>
                        </div> --}}

                        @include('layouts.components.social')

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
