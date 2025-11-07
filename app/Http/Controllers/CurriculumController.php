<?php

namespace App\Http\Controllers;

class CurriculumController extends Controller
{
    public function index()
    {
        $data = [
            'personal' => [
                'name' => 'José Carlos Vieira Netto',
                'title' => 'Desenvolvedor Junior',
                'email' => 'jcnetto.dev@gmail.com',
                'phone' => '+55 (15) 99116-3265',
                'location' => 'Sorocaba - SP, Brasil',
                'linkedin' => 'https://www.linkedin.com/in/jos%C3%A9-carlos-vieira-52b401397/',
                'github' => 'https://github.com/jcnettodev',
                'website' => 'https://cv.euonline.site/',
                'photo' => 'https://avatars.githubusercontent.com/u/241758480?s=400&u=428580bc0b01e1819b278c9599dcea6b735d6e1c&v=4',
            ],
            'about' => 'Vindo de uma carreira empreendedora em eletrônica, mergulhei no mundo da programação há mais de um ano e me apaixonei por construir soluções que resolvem problemas reais. Minha experiência prévia me deu uma forte base em lógica e diagnóstico, que agora aplico no desenvolvimento. Estou sempre em busca de novos desafios e pronto para contribuir em um time dinâmico.',
            'experiences' => [
                [
                    'position' => 'Desenvolvedor Júnior full stack',
                    'company' => 'BSS - BANK',
                    'period' => '2025 - Presente',
                    'description' => 'Desenvolvimento de aplicações web escaláveis usando Laravel, Livewire e Postgres. Planejamento em soluções inteligentes e eficientes.',
                    'achievements' => [
                        'Implementação de arquitetura de microserviços',
                        'Revisão lógicas de negócio e arquitetura de software, visando melhorar a escalabilidade e manutenibilidade do sistema.',
                        'Implementação de testes automatizados para garantir a qualidade do código.',
                    ]
                ],
                [
                    'position' => 'Supervisor de manutenção voltado a tecnologia',
                    'company' => 'Frexco - Comércio e distribuição de alimentos',
                    'period' => '2022 - 2023',
                    'description' => 'Responsável pela manutenção, configuração e implementação de tecnologias operacionais, garantindo o funcionamento de máquinas de seleção, sistemas de monitoramento e hardware de suporte à operação.',
                    'achievements' => [
                        'Configuração e programação de máquinas de seleção de hortifruti.',
                        'Implementação de sistema de monitoramento de temperatura para câmaras frias (utilizando Raspberry Pi) com integração ao banco de dados da empresa.',
                        'Implantação de hardware (tablets fixos) para o sistema de registro de ponto dos funcionários.',
                        'Gerenciamento e configuração de equipamentos de câmara fria.',
                    ]
                ],
                [
                    'position' => 'Empresário',
                    'company' => 'Techphone - Sorocaba / Ontech - Sorocaba',
                    'period' => '2018 - 2022',
                    'description' => 'Manutenção em eletrônicos em Geral (Games, Informática, Celulares, etc) Especializado em recuperação de dados e soluções para escritórios.',
                    'achievements' => [
                        'Mais de 1000 clientes atendidos',
                        'Referencia em Manutenção na cidade de Sorocaba',
                        'Desenvolvimento de sistema de gerenciamento de estoque e vendas',
                    ]
                ],
            ],
            'education' => [
                [
                    'degree' => 'Analista de Sistemas',
                    'institution' => 'Universidade Paulista - Sorocaba (UNIP)',
                    'period' => '2019 - 2022',
                    'description' => 'Formação em Análise de Sistemas, com ênfase em desenvolvimento de software e soluções de TI.',
                ],
                [
                    'degree' => 'PHP - Laravel - Livewire',
                    'institution' => 'Pinguim Academy',
                    'period' => '2025 (Aberto)',
                    'description' => 'Especialização em tecnologias modernas de desenvolvimento web, com foco em PHP, Laravel e Livewire.',
                ],
            ],
            'skills' => [
                'Backend' => ['PHP', 'Laravel', 'Node.js', 'Python', 'MySQL', 'PostgreSQL', 'Redis'],
                'Frontend' => ['JavaScript', 'Vue.js', 'React', 'Tailwind CSS', 'HTML5', 'CSS3'],
                'DevOps' => ['Docker', 'Git', 'CI/CD', 'Coolify', 'Linux'],
                'Outras' => ['Metodologias Ágeis', 'TDD', 'Clean Code', 'Design Patterns', 'RESTful APIs'],
            ],
        ];

        return view('curriculum', $data);
    }
}

