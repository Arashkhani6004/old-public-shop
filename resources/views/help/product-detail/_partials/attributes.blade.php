<div class="info-product">
    <p class="fm-b m-0">
        ویژگی های محصول
    </p>
    <div class="attributes">
        <input type="checkbox" id="expanded">
        <div class="p text-start">
            <ul class="m-0 p-0 mt-2" id="feature-list">
                <li class="list-unstyled fm-re d-flex align-items-center">
                    <i class="bi bi-brightness-alt-high d-flex fs-6 me-1"></i>
                    ویژگی تستی ۱
                </li>
                <li class="list-unstyled fm-re d-flex align-items-center">
                    <i class="bi bi-brightness-alt-high d-flex fs-6 me-1"></i>
                    ویژگی تستی ۲
                </li>
                <li class="list-unstyled fm-re d-flex align-items-center">
                    <i class="bi bi-brightness-alt-high d-flex fs-6 me-1"></i>
                    ویژگی تستی ۳
                </li>
                <li class="list-unstyled fm-re d-flex align-items-center">
                    <i class="bi bi-brightness-alt-high d-flex fs-6 me-1"></i>
                    ویژگی تستی ۴
                </li>
                <li class="list-unstyled fm-re d-flex align-items-center">
                    <i class="bi bi-brightness-alt-high d-flex fs-6 me-1"></i>
                    ویژگی تستی ۵
                </li>
                <li class="list-unstyled fm-re d-flex align-items-center">
                    <i class="bi bi-brightness-alt-high d-flex fs-6 me-1"></i>
                    ویژگی تستی ۶
                </li>
            </ul>
        </div>
        <label for="expanded" role="button" class="show-more-button font-small fm-eb mt-2">
            <span class="show-more d-flex align-items-center">
                <i class="bi bi-plus-lg d-flex me-1"></i>
                مشاهده بیشتر
            </span>
            <span class="show-less d-flex align-items-center">
                <i class="bi bi-dash d-flex me-1"></i>
                مشاهده کمتر
            </span>
        </label>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var featureList = document.getElementById("feature-list");
        var features = featureList.getElementsByTagName("li");
        var showMoreButton = document.querySelector(".show-more-button");
        if (features.length <= 5) {
            showMoreButton.style.display = "none";
        }
    });
</script>