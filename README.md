# 📜 Papyrus Serializer
Serializer interface for [papyrus/event-sourcing](https://github.com/papyrusphp/event-sourcing).

## Installation
This library contains an interface (the contract) for a serializer.
Pick an existing implementation or build your own one.

Optionally, you can use the `SerializableDomainEventSerializer` as fallback or primary serializer.

Existing implementations:
- [papyrus/symfony-serializer](https://github.com/papyrusphp/symfony-serializer) - using [symfony/serializer](https://github.com/symfony/serializer)
