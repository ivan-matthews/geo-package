Получить массивы GEO-данных, для последующей заливки в БД.
В интернете много готовых дампов, а у меня мало ОЗУ.

	composer require ivan-matthews/geo-package
Или

	composer require ivan-matthews/geo-package "dev-master"

https://packagist.org/packages/ivan-matthews/geo-package

``Geo -> getCountriesFiles(callback functio[file] = NULL, sort = SORT_NATURAL)`` - вернуть массив файлов стран

``Geo -> getRegionsFiles(callback functio[file] = NULL, sort = SORT_NATURAL)`` - вернуть массив файлов регионов

``Geo -> getCitiesFiles(callback functio[file] = NULL, sort = SORT_NATURAL)`` - вернуть массив файлов городов

``Geo -> getFileName()`` - вернуть имя текущего файла (без расширения) - полезно, когда надо будет пропустить ранее залитые данные в БД

``Geo -> call(array files_list, callablee function)`` - вызвать колбэк для каждого файла из массива files_list (include / require производим внутри колбэка)

Пример: 

	см. index.php