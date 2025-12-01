# Menggunakan image Nginx resmi [cite: 2760]
FROM nginx

# Hapus konfigurasi default dan ganti dengan konfigurasi kita [cite: 2762]
COPY ./default.conf /etc/nginx/conf.d/default.conf

# Expose port 80 [cite: 2764]
EXPOSE 80

# Jalankan Nginx [cite: 2766]
CMD ["nginx", "-g", "daemon off;"]
