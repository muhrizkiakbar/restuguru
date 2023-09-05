
src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"

numeral(#value).format('$ 0,0') ->mengubah currency jadi Rp. 1.000.000
numeral(#value).format('0[.]00') ->mengubah number jadi 1,3 jadi desimal
numeral(#value).value() -> mengambil data value yg telah terformat
dokumentasi:
numeraljs.com



rm -rf vendor
rm -rf composer.lock
composer self-update --1
composer install --ignore-platform-reqs
