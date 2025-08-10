<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuário administrador
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@blog.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Criar usuário comum
        $user = User::create([
            'name' => 'João Silva',
            'email' => 'joao@blog.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Criar categorias
        $categories = [
            // Posts recentes
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Tudo sobre o framework Laravel',
                'color' => '#FF2D20'
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'description' => 'Dicas e tutoriais de JavaScript',
                'color' => '#F7DF1E'
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'description' => 'Novidades e técnicas em PHP',
                'color' => '#777BB4'
            ],
            [
                'name' => 'Tecnologia',
                'slug' => 'tecnologia',
                'description' => 'Notícias e tendências tecnológicas',
                'color' => '#3B82F6'
            ]
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Criar posts de exemplo
        $posts = [
            [
                'title' => 'Introdução ao Laravel 12',
                'content' => "Laravel 12 trouxe muitas novidades incríveis para o desenvolvimento web moderno.\n\nEste framework PHP continua sendo uma das melhores opções para desenvolvimento ágil e robusto. Neste post, vamos explorar as principais funcionalidades que fazem do Laravel uma ferramenta indispensável.\n\nAlgumas das características que mais se destacam:\n- Eloquent ORM poderoso\n- Sistema de roteamento intuitivo\n- Blade templating engine\n- Artisan CLI para automação\n- Sistema de autenticação completo\n\nSe você está começando no desenvolvimento web ou quer migrar para uma tecnologia mais moderna, Laravel é definitivamente uma excelente escolha.",
                'excerpt' => 'Descubra as novidades e principais funcionalidades do Laravel 12.',
                'user_id' => $admin->id,
                'category_id' => 1,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'JavaScript ES2024: Novas Features',
                'content' => "O JavaScript continua evoluindo rapidamente, e 2024 trouxe funcionalidades impressionantes.\n\nVamos explorar as principais novidades que chegaram na linguagem mais popular da web.\n\nDestaque para:\n- Pattern Matching\n- Records e Tuples\n- Decorators\n- Temporal API\n- Pipeline Operator\n\nEssas funcionalidades prometem tornar o desenvolvimento JavaScript ainda mais produtivo e elegante. É importante manter-se atualizado com essas mudanças para escrever código mais moderno e eficiente.",
                'excerpt' => 'Conheça as novidades mais importantes do JavaScript em 2024.',
                'user_id' => $user->id,
                'category_id' => 2,
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'PHP 8.4: Performance e Novidades',
                'content' => "A nova versão do PHP continua surpreendendo com melhorias significativas.\n\nO PHP 8.4 trouxe otimizações importantes que impactam diretamente na performance das aplicações web.\n\nPrincipais melhorias:\n- JIT Compiler otimizado\n- Novos tipos de dados\n- Melhorias no sistema de tipos\n- Novas funções de array\n- Otimizações de memória\n\nEssas melhorias consolidam o PHP como uma linguagem moderna e performática para desenvolvimento web profissional.",
                'excerpt' => 'Descubra as melhorias de performance e novas funcionalidades do PHP 8.4.',
                'user_id' => $admin->id,
                'category_id' => 3,
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Inteligência Artificial em 2025',
                'content' => "A IA continua transformando como trabalhamos e vivemos.\n\nEm 2025, vemos avanços impressionantes em diversas áreas da inteligência artificial.\n\nTendências principais:\n- IA Generativa mais sofisticada\n- Automação de processos complexos\n- IA na medicina e diagnósticos\n- Assistentes virtuais mais inteligentes\n- IA na educação personalizada\n\nO futuro está chegando mais rápido do que imaginávamos, e é importante estar preparado para essas mudanças.",
                'excerpt' => 'Como a inteligência artificial está moldando o futuro em 2025.',
                'user_id' => $user->id,
                'category_id' => 4,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Criando uma API REST com Laravel',
                'content' => "APIs REST são fundamentais no desenvolvimento moderno.\n\nLaravel oferece ferramentas poderosas para criar APIs robustas e escaláveis de forma simples e elegante.\n\nPontos importantes:\n- Rotas de API dedicadas\n- Serialização automática\n- Throttling e rate limiting\n- Autenticação via tokens\n- Validação de requests\n- Transformação de recursos\n\nCom Laravel, você pode ter uma API profissional funcionando em minutos.",
                'excerpt' => 'Tutorial completo para criar APIs REST profissionais com Laravel.',
                'user_id' => $admin->id,
                'category_id' => 1,
                'is_published' => false, // Post não publicado para exemplo
                'published_at' => null,
            ],
            
            // Posts de meses anteriores para demonstrar o agrupamento
            [
                'title' => 'Vue.js 3: Composition API na Prática',
                'content' => "A Composition API do Vue.js 3 revolucionou como escrevemos componentes Vue.\n\nEsta nova abordagem oferece maior flexibilidade e reutilização de lógica entre componentes.\n\nPrincipais vantagens:\n- Melhor organização de código\n- TypeScript nativo\n- Performance aprimorada\n- Lógica mais reutilizável\n\nVamos explorar como migrar seus componentes para a nova API.",
                'excerpt' => 'Aprenda a usar a Composition API do Vue.js 3 de forma prática.',
                'user_id' => $user->id,
                'category_id' => 2,
                'is_published' => true,
                'published_at' => now()->subMonth()->subDays(10),
            ],
            [
                'title' => 'Docker para Desenvolvedores Laravel',
                'content' => "Docker simplifica drasticamente o ambiente de desenvolvimento Laravel.\n\nCom conteinêrzacao, você garante que sua aplicação rode de forma consistente em qualquer ambiente.\n\nBenefícios principais:\n- Ambiente isolado e reproduzível\n- Fácil setup para novos desenvolvedores\n- Versionamento de dependências\n- Deploy simplificado\n\nLaravel Sail torna essa integração ainda mais simples.",
                'excerpt' => 'Como usar Docker para otimizar seu workflow de desenvolvimento Laravel.',
                'user_id' => $admin->id,
                'category_id' => 1,
                'is_published' => true,
                'published_at' => now()->subMonth()->subDays(20),
            ],
            [
                'title' => 'React Server Components: O Futuro',
                'content' => "Os React Server Components estão mudando fundamentalmente como pensamos sobre renderização.\n\nEsta nova abordagem permite renderizar componentes no servidor, reduzindo o bundle JavaScript enviado ao cliente.\n\nVantagens importantes:\n- Bundle menor no cliente\n- Melhor performance inicial\n- SEO aprimorado\n- Acesso direto a dados do servidor\n\nVamos entender como implementar essa nova tecnologia.",
                'excerpt' => 'Entenda como os React Server Components vão revolucionar o desenvolvimento web.',
                'user_id' => $user->id,
                'category_id' => 2,
                'is_published' => true,
                'published_at' => now()->subMonths(2)->subDays(5),
            ],
            [
                'title' => 'Segurança em Aplicações Web Modernas',
                'content' => "A segurança deve ser uma prioridade desde o início do desenvolvimento.\n\nCom o aumento de ataques cibernéticos, é crucial implementar as melhores práticas de segurança.\n\nPontos essenciais:\n- Autenticação robusta\n- Validação de entrada\n- Proteção CSRF\n- Headers de segurança\n- Criptografia de dados\n\nVamos revisar as principais vulnerabilidades e como evitá-las.",
                'excerpt' => 'Guia completo de segurança para aplicações web modernas.',
                'user_id' => $admin->id,
                'category_id' => 4,
                'is_published' => true,
                'published_at' => now()->subMonths(2)->subDays(15),
            ],
            [
                'title' => 'Node.js: Event Loop e Performance',
                'content' => "Entender o Event Loop do Node.js é fundamental para escrever código performante.\n\nO modelo de concorrência do Node.js é diferente de linguagens tradicionais e oferece vantagens únicas.\n\nConceitos importantes:\n- Single-threaded mas não-bloqueante\n- Callback queue e call stack\n- Phases do Event Loop\n- Worker threads\n- Profiling de performance\n\nVamos mergulhar nos detalhes dessa arquitetura.",
                'excerpt' => 'Domine o Event Loop do Node.js para escrever aplicações mais eficientes.',
                'user_id' => $user->id,
                'category_id' => 2,
                'is_published' => true,
                'published_at' => now()->subMonths(3)->subDays(8),
            ],
            [
                'title' => 'Microserviços com Laravel e API Gateway',
                'content' => "A arquitetura de microserviços oferece escalabilidade e flexibilidade para grandes aplicações.\n\nLaravel se adapta perfeitamente a essa arquitetura, especialmente com Lumen para APIs leves.\n\nComponentes essenciais:\n- API Gateway\n- Service discovery\n- Load balancing\n- Circuit breakers\n- Distributed tracing\n\nVamos implementar uma arquitetura robusta passo a passo.",
                'excerpt' => 'Como implementar microserviços usando Laravel e padrões modernos.',
                'user_id' => $admin->id,
                'category_id' => 1,
                'is_published' => true,
                'published_at' => now()->subMonths(3)->subDays(25),
            ]
        ];

        foreach ($posts as $postData) {
            $post = Post::create($postData);

            // Adicionar alguns comentários aos posts publicados
            if ($post->is_published) {
                Comment::create([
                    'content' => 'Excelente post! Muito esclarecedor.',
                    'author_name' => 'Maria Santos',
                    'author_email' => 'maria@email.com',
                    'is_approved' => true,
                    'post_id' => $post->id,
                ]);

                if (rand(0, 1)) {
                    Comment::create([
                        'content' => 'Obrigado por compartilhar esse conhecimento!',
                        'author_name' => 'Pedro Oliveira',
                        'author_email' => 'pedro@email.com',
                        'is_approved' => true,
                        'post_id' => $post->id,
                    ]);
                }
            }
        }
    }
}
