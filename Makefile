build:
	docker build . -t stubs

bsh:
	docker run -it -v $(pwd -P):/src stubs