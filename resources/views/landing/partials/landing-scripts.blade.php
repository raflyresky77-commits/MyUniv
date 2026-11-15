    <script>

        // Inisialisasi Lucide Icon dari Code 1
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const toggle = document.getElementById('mobileMenuToggle');
            if (!menu) return;

            const isOpening = menu.classList.contains('hidden');
            menu.classList.toggle('hidden', !isOpening);

            if (toggle) {
                toggle.setAttribute('aria-expanded', String(isOpening));
                toggle.setAttribute('aria-label', isOpening ? 'Tutup menu navigasi' : 'Buka menu navigasi');
                const icon = document.getElementById('menuIcon');
                if (icon) {
                    icon.classList.toggle('fa-bars', !isOpening);
                    icon.classList.toggle('fa-xmark', isOpening);
                }
            }
        }

        function toggleChatbot() {
            const chatbot = document.getElementById('chatbotContainer');
            chatbot.classList.toggle('hidden');
        }

        // Accordion FAQ Interactivity
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                const p = item.querySelector('p');
                const icon = item.querySelector('i');
                const isHidden = p.classList.contains('hidden');

                faqItems.forEach(other => {
                    other.querySelector('p').classList.add('hidden');
                    other.querySelector('i').style.transform = 'rotate(0deg)';
                });

                if (isHidden) {
                    p.classList.remove('hidden');
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });

        // Filter Cards Kampus (Pencarian Rekomendasi Kampus)
        function filterCards() {
            const query = document.getElementById('searchCampus').value.toLowerCase();
            const cards = document.querySelectorAll('.campus-card');

            cards.forEach(card => {
                const title = card.querySelector('.campus-title').textContent.toLowerCase();
                const major = card.querySelector('.campus-major').textContent.toLowerCase();

                if (title.includes(query) || major.includes(query)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Interaktivitas Percaya Diri Melangkah (Testimonial Spotlight)
        const testimonialData = {
            1: {
                text: '"Tesnya sangat interaktif dan hasilnya sesuai banget dengan minat koding saya. Rekomendasi kampusnya membantu saya menentukan SNBP!"',
                author: 'Anggia Tresa',
                role: 'Siswa XII RPL - Lolos SNBP Teknik Informatika',
                avatar: 'A'
            },
            2: {
                text: '"Awalnya bingung bedanya S1 dan D4, tapi lewat fitur Education Planning di MyUniv semuanya jadi terstruktur dengan rapi."',
                author: 'Tiara Maharani',
                role: 'Siswa XII TKJ - Persiapan Mandiri Telkom Univ',
                avatar: 'B'
            },
            3: {
                text: '"Fitur konsultasi ke Guru BK via WhatsApp gampang banget, tinggal klik langsung terhubung dengan template pesan yang sopan."',
                author: 'Salsabila',
                role: 'Siswa XII - Lolos SNBP Elektro',
                avatar: 'C'
            }
        };

        function setActiveTestimonial(id) {
            const spotlightText = document.getElementById('spotlight-text');
            const spotlightAuthor = document.getElementById('spotlight-author');
            const spotlightRole = document.getElementById('spotlight-role');
            const spotlightAvatar = document.getElementById('spotlight-avatar');

            if (testimonialData[id]) {
                spotlightText.textContent = testimonialData[id].text;
                spotlightAuthor.textContent = testimonialData[id].author;
                spotlightRole.textContent = testimonialData[id].role;
                spotlightAvatar.textContent = testimonialData[id].avatar;

                document.querySelectorAll('.testi-card').forEach(card => {
                    card.classList.remove('border-2', 'border-coralOrange', 'ring-2', 'ring-coralOrange/20');
                    card.classList.add('border', 'border-gray-200', 'opacity-80');
                });

                const activeCard = document.getElementById(`testi-card-${id}`);
                if (activeCard) {
                    activeCard.classList.remove('border', 'border-gray-200', 'opacity-80');
                    activeCard.classList.add('border-2', 'border-coralOrange', 'ring-2', 'ring-coralOrange/20');
                }
            }
        }

        // Kuis Interaktif Steps & Logic
        function nextQuizStep(currentStep, category) {
            const currentStepEl = document.querySelector(`.quiz-step[data-step="${currentStep}"]`);
            const nextStepEl = document.querySelector(`.quiz-step[data-step="${currentStep + 1}"]`);

            if (currentStepEl && nextStepEl) {
                currentStepEl.classList.add('hidden');
                nextStepEl.classList.remove('hidden');

                const percent = Math.round(((currentStep + 1) / 3) * 100);
                document.getElementById('quiz-progress-text').textContent = `Pertanyaan ${currentStep + 1} dari 3`;
                document.getElementById('quiz-progress-percent').textContent = `${percent}%`;
                document.getElementById('quiz-progress-bar').style.width = `${percent}%`;
            }
        }

        function showQuizResult(category) {
            document.querySelectorAll('.quiz-step').forEach(step => step.classList.add('hidden'));
            const resultEl = document.getElementById('quiz-result');
            resultEl.classList.remove('hidden');

            document.getElementById('quiz-progress-text').textContent = 'Selesai!';
            document.getElementById('quiz-progress-percent').textContent = '100%';
            document.getElementById('quiz-progress-bar').style.width = '100%';

            const titleEl = document.getElementById('result-title');
            const descEl = document.getElementById('result-desc');

            if (category === 'tekno') {
                titleEl.textContent = 'Rekomendasi Awal Mauny: Bidang Teknologi & IT 💻';
                descEl.textContent = 'Kamu memiliki ketertarikan tinggi pada logika, pemrograman, dan teknologi digital! Jurusan yang pas: Teknik Informatika, Rekayasa Perangkat Lunak, atau Data Science.';
            } else if (category === 'desain') {
                titleEl.textContent = 'Rekomendasi Awal Mauny: Bidang Industri Kreatif 🎨';
                descEl.textContent = 'Jiwa seni dan visualmu sangat menonjol! Jurusan rekomendasi: Desain Komunikasi Visual (DKV), Desain Produk, Animasi, atau UI/UX Design.';
            } else if (category === 'bisnis') {
                titleEl.textContent = 'Rekomendasi Awal Mauny: Bidang Bisnis & Manajemen 📊';
                descEl.textContent = 'Kamu bakat dalam kepemimpinan dan analisis peluang! Jurusan rekomendasi: Bisnis Digital, Manajemen, Kewirausahaan, atau Akuntansi.';
            } else {
                titleEl.textContent = 'Rekomendasi Awal Mauny: Bidang Humaniora & Sosial 🤝';
                descEl.textContent = 'Kamu memiliki kepedulian sosial dan komunikasi interpersonal yang baik! Jurusan rekomendasi: Psikologi, Ilmu Komunikasi, atau Bimbingan Konseling.';
            }
        }

        function resetQuiz() {
            document.getElementById('quiz-result').classList.add('hidden');
            document.querySelectorAll('.quiz-step').forEach((step, idx) => {
                if (idx === 0) step.classList.remove('hidden');
                else step.classList.add('hidden');
            });

            document.getElementById('quiz-progress-text').textContent = 'Pertanyaan 1 dari 3';
            document.getElementById('quiz-progress-percent').textContent = '33%';
            document.getElementById('quiz-progress-bar').style.width = '33%';
        }

        // Chatbot Handlers
        function sendQuickMessage(text) {
            const input = document.getElementById('chatInput');
            input.value = text;
            handleChatSubmit(new Event('submit'));
        }

        function handleChatSubmit(e) {
            e.preventDefault();
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            if (!message) return;

            const chatMessages = document.getElementById('chatMessages');

            // User Message
            const userBubble = document.createElement('div');
            userBubble.className = 'flex items-start gap-2 justify-end max-w-[85%] ml-auto';
            userBubble.innerHTML = `
                <div class="bg-indigoPrimary text-white p-3 rounded-2xl rounded-tr-none shadow-sm leading-relaxed">
                    ${message}
                </div>
            `;
            chatMessages.appendChild(userBubble);
            input.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Bot Response Simulation
            setTimeout(() => {
                const botBubble = document.createElement('div');
                botBubble.className = 'flex items-start gap-2 max-w-[85%]';
                botBubble.innerHTML = `
                    <div class="w-7 h-7 rounded-full bg-indigoPrimary text-white flex items-center justify-center shrink-0 font-bold text-[10px]">🐉</div>
                    <div class="bg-white border border-indigoPrimary/10 p-3 rounded-2xl rounded-tl-none shadow-sm text-gray-700 leading-relaxed">
                        Terima kasih pertanyaannya! Mauny menyarankan kamu untuk mencoba fitur <strong>Tes Peminatan</strong> atau mengecek halaman <strong>Rekomendasi Kampus</strong> untuk informasi lebih detail.
                    </div>
                `;
                chatMessages.appendChild(botBubble);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 800);
        }

    </script>
