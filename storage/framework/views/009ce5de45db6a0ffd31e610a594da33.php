<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($personal['name']); ?> - Currículo</title>
    <meta name="description" content="Currículo profissional de <?php echo e($personal['name']); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Header Hero Section -->
    <header class="animated-gradient text-white py-20 md:py-32 relative overflow-hidden rounded-b-3xl md:rounded-b-[3rem]">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="container mx-auto px-4 md:px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-center gap-8 md:gap-12">
                <!-- Foto de Perfil -->
                <div class="animate-float">
                    <img src="<?php echo e($personal['photo']); ?>" 
                         alt="<?php echo e($personal['name']); ?>" 
                         class="w-48 h-48 md:w-64 md:h-64 rounded-full border-8 border-white shadow-2xl object-cover">
                </div>
                
                <!-- Informações Pessoais -->
                <div class="text-center md:text-left animate-slide-in-right">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fade-in drop-shadow-lg">
                        <?php echo e($personal['name']); ?>

                    </h1>
                    <p class="text-2xl md:text-3xl font-light mb-6 opacity-90">
                        <?php echo e($personal['title']); ?>

                    </p>
                    
                    <!-- Contatos -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-4 mb-6 text-sm md:text-base">
                        <a href="mailto:<?php echo e($personal['email']); ?>" 
                           class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full hover:bg-white/30 transition shine-effect">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <?php echo e($personal['email']); ?>

                        </a>
                        
                        <a href="https://wa.me/5515991163265" 
                           target="_blank"
                           class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full hover:bg-white/30 transition shine-effect">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <?php echo e($personal['phone']); ?>

                        </a>
                        
                        <span class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <?php echo e($personal['location']); ?>

                        </span>
                    </div>
                    
                    <!-- Links Sociais -->
                    <div class="flex justify-center md:justify-start gap-4">
                        <a href="<?php echo e($personal['linkedin']); ?>" 
                           target="_blank"
                           class="bg-white text-blue-600 p-3 rounded-full hover:scale-110 transition-transform shadow-lg shine-effect">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        
                        <a href="<?php echo e($personal['github']); ?>" 
                           target="_blank"
                           class="bg-white text-blue-600 p-3 rounded-full hover:scale-110 transition-transform shadow-lg shine-effect">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        
                        <a href="<?php echo e($personal['website']); ?>" 
                           target="_blank"
                           class="bg-white text-blue-600 p-3 rounded-full hover:scale-110 transition-transform shadow-lg shine-effect">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 md:px-6 py-12 md:py-16">
        
        <!-- Seção: Sobre mim -->
        <section id="about" class="mb-16 scroll-animate">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 gradient-text">Sobre Mim</h2>
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-10 card-hover">
                <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                    <?php echo e($about); ?>

                </p>
            </div>
        </section>

        <!-- Seção: Experiência Profissional -->
        <section id="experience" class="mb-16 scroll-animate">
            <h2 class="text-3xl md:text-4xl font-bold mb-8 gradient-text">Experiência Profissional</h2>
            <div class="space-y-6">
                <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 card-hover scroll-animate" 
                     style="animation-delay: <?php echo e($index * 0.1); ?>s">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-1">
                                <?php echo e($experience['position']); ?>

                            </h3>
                            <p class="text-xl text-blue-600 font-semibold">
                                <?php echo e($experience['company']); ?>

                            </p>
                        </div>
                        <span class="inline-block mt-2 md:mt-0 bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">
                            <?php echo e($experience['period']); ?>

                        </span>
                    </div>
                    
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        <?php echo e($experience['description']); ?>

                    </p>
                    
                    <?php if(isset($experience['achievements']) && count($experience['achievements']) > 0): ?>
                    <div class="mt-4">
                        <h4 class="font-semibold text-gray-900 mb-2">Principais Conquistas:</h4>
                        <ul class="space-y-2">
                            <?php $__currentLoopData = $experience['achievements']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700"><?php echo e($achievement); ?></span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <!-- Seção: Formação Acadêmica -->
        <section id="education" class="mb-16 scroll-animate">
            <h2 class="text-3xl md:text-4xl font-bold mb-8 gradient-text">Formação Acadêmica</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <?php $__currentLoopData = $education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 card-hover scroll-animate" 
                     style="animation-delay: <?php echo e($index * 0.1); ?>s">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="bg-blue-100 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">
                                <?php echo e($edu['degree']); ?>

                            </h3>
                            <p class="text-lg text-blue-600 font-semibold mb-2">
                                <?php echo e($edu['institution']); ?>

                            </p>
                            <span class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                <?php echo e($edu['period']); ?>

                            </span>
                        </div>
                    </div>
                    <p class="text-gray-700"><?php echo e($edu['description']); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <!-- Seção: Habilidades -->
        <section id="skills" class="mb-16 scroll-animate">
            <h2 class="text-3xl md:text-4xl font-bold mb-8 gradient-text">Habilidades Técnicas</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $skillList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 card-hover">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                        <?php echo e($category); ?>

                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <?php $__currentLoopData = $skillList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="skill-badge bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-md">
                            <?php echo e($skill); ?>

                        </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="scroll-animate">
            <div class="gradient-bg rounded-2xl shadow-2xl p-8 md:p-12 text-center text-white">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Vamos Trabalhar Juntos?
                </h2>
                <p class="text-lg md:text-xl mb-8 opacity-90">
                    Estou sempre aberto a novos desafios e oportunidades interessantes.
                </p>
                <a href="mailto:<?php echo e($personal['email']); ?>" 
                   class="inline-block bg-white text-blue-600 px-8 py-4 rounded-full font-bold text-lg hover:scale-105 transition-transform shadow-lg shine-effect">
                    Entre em Contato
                </a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-16">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <p class="text-gray-400">
                &copy; <?php echo e(date('Y')); ?> <?php echo e($personal['name']); ?>. Todos os direitos reservados.
            </p>
            <p class="text-gray-500 text-sm mt-2">
                Desenvolvido com Laravel e Tailwind CSS
            </p>
        </div>
    </footer>

</body>
</html>

<?php /**PATH /home/ossometal/Documentos/Github/Curriculum/resources/views/curriculum.blade.php ENDPATH**/ ?>