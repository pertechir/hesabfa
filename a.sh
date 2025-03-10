#!/bin/bash  

# نام دایرکتوری اصلی  
MAIN_DIR="Hesabfa"  

# ایجاد دایرکتوری اصلی  
mkdir -p "$MAIN_DIR"  

# ایجاد فایل index.php در دایرکتوری اصلی  
touch "$MAIN_DIR/index.php"  

# ایجاد دایرکتوری dashboard  
mkdir -p "$MAIN_DIR/dashboard"  
touch "$MAIN_DIR/dashboard/index.php"  

# ایجاد دایرکتوری ashkhas  
mkdir -p "$MAIN_DIR/ashkhas"  
touch "$MAIN_DIR/ashkhas/shakhs_jadid.php"  
touch "$MAIN_DIR/ashkhas/ashkhas.php"  

# ایجاد دایرکتوری kala_khadamat  
mkdir -p "$MAIN_DIR/kala_khadamat"  
touch "$MAIN_DIR/kala_khadamat/mahsol_jadid.php"  
touch "$MAIN_DIR/kala_khadamat/fehrest_mahsolat.php"  
touch "$MAIN_DIR/kala_khadamat/khadamat_jadid.php"  
touch "$MAIN_DIR/kala_khadamat/fehrest_khadamat.php"  
touch "$MAIN_DIR/kala_khadamat/update_ghimat.php"  

# ایجاد دایرکتوری forosh_daramad  
mkdir -p "$MAIN_DIR/forosh_daramad"  
touch "$MAIN_DIR/forosh_daramad/forosh_jadid.php"  
touch "$MAIN_DIR/forosh_daramad/factore_sريع.php"  
touch "$MAIN_DIR/forosh_daramad/bargesht_az_forosh.php"  
touch "$MAIN_DIR/forosh_daramad/factorehaye_forosh.php"  
touch "$MAIN_DIR/forosh_daramad/factorehaye_bargasht_az_forosh.php"  
touch "$MAIN_DIR/forosh_daramad/daramad.php"  
touch "$MAIN_DIR/forosh_daramad/liste_daramadha.php"  
touch "$MAIN_DIR/forosh_daramad/gharadad_forosh_aghsati.php"  
touch "$MAIN_DIR/forosh_daramad/liste_forosh_aghsati.php"  
touch "$MAIN_DIR/forosh_daramad/aghlam_takhfif_dar.php"  

# ایجاد دایرکتوری kharid_hazine  
mkdir -p "$MAIN_DIR/kharid_hazine"  
touch "$MAIN_DIR/kharid_hazine/kharid_jadid.php"  
touch "$MAIN_DIR/kharid_hazine/bargesht_az_kharid.php"  
touch "$MAIN_DIR/kharid_hazine/factorehaye_kharid.php"  
touch "$MAIN_DIR/kharid_hazine/factorehaye_bargasht_az_kharid.php"  
touch "$MAIN_DIR/kharid_hazine/hazine.php"  
touch "$MAIN_DIR/kharid_hazine/liste_hazineha.php"  

# ایجاد دایرکتوری anbardari  
mkdir -p "$MAIN_DIR/anbardari"  
touch "$MAIN_DIR/anbardari/anbarha.php"  
touch "$MAIN_DIR/anbardari/havale_jadid.php"  
touch "$MAIN_DIR/anbardari/resid_havalehaye_anbar.php"  
touch "$MAIN_DIR/anbardari/mojoodi_kala.php"  
touch "$MAIN_DIR/anbardari/mojoodi_tamami_anbarha.php"  
touch "$MAIN_DIR/anbardari/anbargardani.php"  

# ایجاد دایرکتوری gozareshha  
mkdir -p "$MAIN_DIR/gozareshha"  
touch "$MAIN_DIR/gozareshha/index.php"  

# ایجاد دایرکتوری tanzimat  
mkdir -p "$MAIN_DIR/tanzimat"  
touch "$MAIN_DIR/tanzimat/index.php"  

echo "ساختار دایرکتوری با موفقیت ایجاد شد."  

# نمایش ساختار درختی  
tree "$MAIN_DIR"  