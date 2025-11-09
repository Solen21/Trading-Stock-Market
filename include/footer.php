
<?php if (isset($_SESSION['user_id'])): ?>
            </div> <!-- Close main-content -->
        </div> <!-- Close content -->
    </div> <!-- Close wrapper -->
    <!-- Dark Overlay element -->
    <div class="overlay"></div>
<?php endif; ?>
    
    <canvas id="motion-canvas"></canvas>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- GSAP CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo $base_path; ?>assets/js/admin_scripts.js"></script>
</body>
</html>