<div class="w-full flex justify-center">
    <div id="denah-container"
        class="overflow-hidden border rounded-lg w-full max-w-5xl mx-auto relative"
        style="height: auto; cursor: grab;">
        <img src="{{ asset('img/assets/denah.jpg') }}"
            alt="Denah Penyimpanan"
            id="denah-image"
            class="w-full h-auto select-none transition-transform duration-300 ease-in-out"
            style="transform-origin: center center;" />
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById("denah-container");
        const img = document.getElementById("denah-image");

        let zoomedIn = false;
        let scale = 1;
        let isDragging = false;
        let startX, startY, currentX = 0,
            currentY = 0;

        // Klik untuk zoom in/out
        img.addEventListener("click", () => {
            if (zoomedIn) {
                scale = 1;
                currentX = 0;
                currentY = 0;
                img.style.transform = `translate(0px, 0px) scale(${scale})`;
                container.style.cursor = "grab";
            } else {
                scale = 2; // bisa diubah misal 3x
                img.style.transform = `translate(0px, 0px) scale(${scale})`;
                container.style.cursor = "grab";
            }
            zoomedIn = !zoomedIn;
        });

        // Drag saat zoom in
        container.addEventListener("mousedown", (e) => {
            if (!zoomedIn) return;
            isDragging = true;
            startX = e.clientX - currentX;
            startY = e.clientY - currentY;
            container.style.cursor = "grabbing";
        });

        container.addEventListener("mousemove", (e) => {
            if (!isDragging) return;
            currentX = e.clientX - startX;
            currentY = e.clientY - startY;
            img.style.transform = `translate(${currentX}px, ${currentY}px) scale(${scale})`;
        });

        container.addEventListener("mouseup", () => {
            isDragging = false;
            container.style.cursor = zoomedIn ? "grab" : "default";
        });

        container.addEventListener("mouseleave", () => {
            isDragging = false;
            container.style.cursor = zoomedIn ? "grab" : "default";
        });
    });
</script>